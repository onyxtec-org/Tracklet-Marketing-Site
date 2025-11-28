<?php

namespace App\Http\Controllers;

use App\Models\OrganizationInvitation;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Spatie\Permission\Models\Role;

class OrganizationInvitationController extends Controller
{
    use ApiResponse;

    /**
     * Show invitation acceptance form
     */
    public function show(string $token)
    {
        $invitation = OrganizationInvitation::where('token', $token)->firstOrFail();

        if (!$invitation->isValid()) {
            if ($invitation->isExpired()) {
                return $this->respondError('This invitation has expired.', 410);
            }
            if ($invitation->isAccepted()) {
                return $this->respondError('This invitation has already been accepted.', 400);
            }
        }

        return $this->respond(
            ['invitation' => $invitation],
            'auth.accept-invitation',
            ['invitation' => $invitation]
        );
    }

    /**
     * Accept invitation and create user account
     */
    public function accept(Request $request, string $token)
    {
        $invitation = OrganizationInvitation::where('token', $token)->firstOrFail();

        if (!$invitation->isValid()) {
            if ($invitation->isExpired()) {
                return $this->respondError('This invitation has expired.', 410);
            }
            if ($invitation->isAccepted()) {
                return $this->respondError('This invitation has already been accepted.', 400);
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|in:' . $invitation->email, // Must match invitation email exactly
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->respondError('Validation failed.', 422, $validator->errors()->toArray());
        }

        // Double-check email matches invitation (security)
        if ($request->email !== $invitation->email) {
            return $this->respondError('Email must match the invitation email.', 422);
        }

        try {
            DB::beginTransaction();

            // Check if user already exists with this email
            $user = User::where('email', $invitation->email)->first();

            if ($user) {
                // If user exists but belongs to different organization, prevent
                if ($user->organization_id && $user->organization_id !== $invitation->organization_id) {
                    return $this->respondError('This email is already associated with another organization.', 422);
                }
                
                // User exists, update and assign to organization
                $user->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'organization_id' => $invitation->organization_id,
                    'email_verified_at' => now(),
                ]);
            } else {
                // Create new user - THIS IS THE ORGANIZATION'S FIRST ADMIN ACCOUNT
                $user = User::create([
                    'name' => $request->name,
                    'email' => $invitation->email, // Use invitation email, not request email
                    'password' => Hash::make($request->password),
                    'organization_id' => $invitation->organization_id,
                    'email_verified_at' => now(),
                ]);
            }

            // Assign admin role - Organization's first account becomes admin
            $adminRole = Role::where('name', 'admin')->first();
            if ($adminRole && !$user->hasRole('admin')) {
                $user->assignRole($adminRole);
            }

            // Mark invitation as accepted
            $invitation->update([
                'accepted_at' => now(),
            ]);

            DB::commit();

            // Redirect to subscription checkout
            auth()->login($user);

            return $this->respond([
                'message' => 'Invitation accepted successfully. Please complete your subscription.',
                'redirect' => route('subscription.checkout'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError('Failed to accept invitation: ' . $e->getMessage(), 500);
        }
    }
}
