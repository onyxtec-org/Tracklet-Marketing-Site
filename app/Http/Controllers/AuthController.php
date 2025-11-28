<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * Register new organization and create admin account
     * Returns token for API requests
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|string|max:255',
            'organization_slug' => 'nullable|string|max:255|unique:organizations,slug|regex:/^[a-z0-9-]+$/',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:organizations,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->respondError('Validation failed.', 422, $validator->errors()->toArray());
        }

        try {
            // Generate slug if not provided
            $slug = $request->organization_slug ?? Str::slug($request->organization_name);

            // Ensure slug is unique
            $baseSlug = $slug;
            $counter = 1;
            while (Organization::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Create organization (self-registered)
            $organization = Organization::create([
                'name' => $request->organization_name,
                'slug' => $slug,
                'email' => $request->email,
                'is_subscribed' => false,
                'is_active' => true,
                'registration_source' => 'self_registered',
            ]);

            // Create admin user account (first account = admin)
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'organization_id' => $organization->id,
                'email_verified_at' => now(),
                'must_change_password' => false,
            ]);

            // Assign admin role
            $adminRole = \Spatie\Permission\Models\Role::where('name', 'admin')->first();
            if ($adminRole) {
                $user->assignRole($adminRole);
            }

            // For API requests, return token
            if ($request->expectsJson() || $request->is('api/*')) {
                $token = $user->createToken('auth-token')->plainTextToken;
                
                return response()->json([
                    'success' => true,
                    'message' => 'Organization registered successfully! Please complete your subscription.',
                    'data' => [
                        'user' => $user->load('roles', 'organization'),
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'must_change_password' => false,
                        'redirect' => route('subscription.checkout'),
                    ],
                ], 201);
            }

            // For web requests, auto-login and redirect
            Auth::login($user);

            return $this->respond([
                'message' => 'Organization registered successfully! Please complete your subscription.',
                'redirect' => route('subscription.checkout'),
            ]);

        } catch (\Exception $e) {
            return $this->respondError('Failed to register organization: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Login user
     * Returns token for API requests
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->respondError('Validation failed.', 422, $validator->errors()->toArray());
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $user->load('roles', 'organization');

            // Check if user must change password
            $mustChangePassword = $user->must_change_password ?? false;

            // For API requests, return token
            if ($request->expectsJson() || $request->is('api/*')) {
                $token = $user->createToken('auth-token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'user' => $user,
                        'token' => $token,
                        'token_type' => 'Bearer',
                        'must_change_password' => $mustChangePassword,
                    ],
                ], 200);
            }

            // For web requests, check password change requirement
            if ($mustChangePassword) {
                return redirect()->route('password.change')->with('warning', 'You must change your password before continuing.');
            }

            return redirect()->intended('/');
        }

        return $this->respondError('Invalid credentials.', 401);
    }

    /**
     * Logout user
     * Revokes token for API requests
     */
    public function logout(Request $request)
    {
        // For API requests, revoke token
        if ($request->expectsJson() || $request->is('api/*')) {
            $request->user()->currentAccessToken()->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        }

        // For web requests, logout session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Get authenticated user
     */
    public function user(Request $request)
    {
        $user = $request->user();
        $user->load('roles', 'organization');

        return $this->respond([
            'user' => $user,
            'must_change_password' => $user->must_change_password ?? false,
        ]);
    }

    /**
     * Show password change form
     */
    public function showChangePasswordForm()
    {
        $user = auth()->user();
        
        if (!$user->must_change_password) {
            return redirect()->route('dashboard.index');
        }

        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        return view('auth.change-password', [
            'pageConfigs' => $pageConfigs,
            'user' => $user,
        ]);
    }

    /**
     * Change password (for users who must change password)
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->respondError('Validation failed.', 422, $validator->errors()->toArray());
            }
            return back()->withErrors($validator)->withInput();
        }

        $user = $request->user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return $this->respondError('Current password is incorrect.', 422);
            }
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
            'must_change_password' => false,
        ]);

        if ($request->expectsJson() || $request->is('api/*')) {
            return $this->respond([
                'message' => 'Password changed successfully.',
                'user' => $user->fresh()->load('roles', 'organization'),
            ]);
        }

        return redirect()->route('dashboard.index')->with('success', 'Password changed successfully. You can now access all features.');
    }
}
