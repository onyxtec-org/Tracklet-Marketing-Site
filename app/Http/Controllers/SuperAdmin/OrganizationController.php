<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\OrganizationInvitationMail;
use App\Models\Organization;
use App\Models\OrganizationInvitation;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of organizations.
     */
    public function index()
    {
        if (request()->ajax() || request()->expectsJson()) {
            $organizations = Organization::with(['users.roles', 'invitations'])
                ->latest()
                ->get()
                ->map(function ($org) {
                    // Get latest invitation
                    $latestInvitation = $org->invitations->sortByDesc('created_at')->first();
                    
                    // Determine invitation status
                    $invitationStatus = 'none';
                    if ($latestInvitation) {
                        if ($latestInvitation->isAccepted()) {
                            $invitationStatus = 'joined';
                        } elseif ($latestInvitation->isExpired()) {
                            $invitationStatus = 'expired';
                        } else {
                            $invitationStatus = 'pending';
                        }
                    }
                    
                    // Get admin user
                    $admin = $org->users->first(function ($user) {
                        return $user->hasRole('admin');
                    });
                    
                    return [
                        'id' => $org->id,
                        'name' => $org->name,
                        'email' => $org->email,
                        'admin' => $admin ? ['name' => $admin->name, 'email' => $admin->email] : null,
                        'is_active' => $org->is_active,
                        'is_subscribed' => $org->is_subscribed,
                        'registration_source' => $org->registration_source ?? 'invited',
                        'invitation_status' => $invitationStatus,
                        'invitation_sent_at' => $latestInvitation ? $latestInvitation->created_at : null,
                        'invitation_accepted_at' => $latestInvitation ? $latestInvitation->accepted_at : null,
                        'created_at' => $org->created_at,
                    ];
                });

            return $this->respond(['data' => $organizations]);
        }

        $organizations = Organization::with(['users.roles', 'invitations'])
            ->latest()
            ->paginate(15);

        return $this->respond(
            ['organizations' => $organizations],
            'superadmin.organizations.index',
            ['organizations' => $organizations]
        );
    }

    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {
        return $this->respond(
            null,
            'superadmin.organizations.create'
        );
    }

    /**
     * Store a newly created organization and send invitation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organization_invitations,email',
        ]);

        try {
            DB::beginTransaction();

            // Generate slug from organization name
            $slug = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $baseSlug = $slug;
            $counter = 1;
            while (Organization::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Create organization (invited)
            $organization = Organization::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'email' => $validated['email'],
                'is_subscribed' => false,
                'is_active' => true,
                'registration_source' => 'invited',
            ]);

            // Create invitation
            $invitation = OrganizationInvitation::create([
                'organization_id' => $organization->id,
                'email' => $validated['email'],
                'invited_by' => auth()->id(),
                'expires_at' => now()->addDays(7),
            ]);

            // Send invitation email
            Mail::to($validated['email'])->send(new OrganizationInvitationMail($invitation));

            DB::commit();

            return $this->respond([
                'message' => 'Organization created and invitation sent successfully.',
                'organization' => $organization,
                'invitation' => $invitation,
            ], null, [], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError('Failed to create organization: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified organization.
     */
    public function show(Organization $organization)
    {
        $organization->load(['users.roles', 'invitations']);

        return $this->respond(
            ['organization' => $organization],
            'superadmin.organizations.show',
            ['organization' => $organization]
        );
    }

    /**
     * Show the form for editing the specified organization.
     */
    public function edit(Organization $organization)
    {
        return $this->respond(
            ['organization' => $organization],
            'superadmin.organizations.edit',
            ['organization' => $organization]
        );
    }

    /**
     * Update the specified organization.
     */
    public function update(Request $request, Organization $organization)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('organizations', 'slug')->ignore($organization->id),
            ],
            'is_active' => 'boolean',
        ]);

        $organization->update($validated);

        return $this->respond([
            'message' => 'Organization updated successfully.',
            'organization' => $organization->fresh(),
        ]);
    }

    /**
     * Remove the specified organization.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return $this->respond([
            'message' => 'Organization deleted successfully.',
        ]);
    }

    /**
     * Resend invitation to organization admin
     */
    public function resendInvitation(Organization $organization)
    {
        $latestInvitation = $organization->invitations()
            ->where('email', $organization->email)
            ->latest()
            ->first();

        if (!$latestInvitation) {
            return $this->respondError('No invitation found for this organization.', 404);
        }

        if ($latestInvitation->isAccepted()) {
            return $this->respondError('Invitation has already been accepted.', 400);
        }

        // Create new invitation
        $invitation = OrganizationInvitation::create([
            'organization_id' => $organization->id,
            'email' => $organization->email,
            'invited_by' => auth()->id(),
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($organization->email)->send(new OrganizationInvitationMail($invitation));

        return $this->respond([
            'message' => 'Invitation resent successfully.',
            'invitation' => $invitation,
        ]);
    }
}
