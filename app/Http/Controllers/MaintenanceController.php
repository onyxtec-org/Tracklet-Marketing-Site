<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\MaintenanceRecord;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of maintenance records.
     */
    public function index(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $query = MaintenanceRecord::where('organization_id', $organization->id)
            ->with(['asset', 'user']);

        // Filters
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('asset_id') && $request->asset_id) {
            $query->where('asset_id', $request->asset_id);
        }

        if ($request->has('upcoming') && $request->upcoming) {
            $query->where('status', 'pending')
                  ->where('scheduled_date', '>=', now())
                  ->where('scheduled_date', '<=', now()->addDays(7));
        }

        $records = $query->orderBy('scheduled_date', 'asc')->paginate(20);

        // Get assets for filter
        $assets = Asset::where('organization_id', $organization->id)
            ->where('status', '!=', 'retired')
            ->orderBy('name')
            ->get();

        // Get upcoming maintenance count
        $upcomingCount = MaintenanceRecord::where('organization_id', $organization->id)
            ->where('status', 'pending')
            ->where('scheduled_date', '>=', now())
            ->where('scheduled_date', '<=', now()->addDays(7))
            ->count();

        return $this->respond(
            [
                'records' => $records,
                'assets' => $assets,
                'upcoming_count' => $upcomingCount,
                'filters' => $request->only(['status', 'type', 'asset_id', 'upcoming']),
            ],
            'maintenance.index',
            [
                'records' => $records,
                'assets' => $assets,
                'upcoming_count' => $upcomingCount,
                'filters' => $request->only(['status', 'type', 'asset_id', 'upcoming']),
            ]
        );
    }

    /**
     * Show the form for creating a new maintenance record.
     */
    public function create(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $assets = Asset::where('organization_id', $organization->id)
            ->where('status', '!=', 'retired')
            ->orderBy('name')
            ->get();

        $assetId = $request->get('asset_id');

        return $this->respond(
            [
                'assets' => $assets,
                'asset_id' => $assetId,
            ],
            'maintenance.create',
            [
                'assets' => $assets,
                'asset_id' => $assetId,
            ]
        );
    }

    /**
     * Store a newly created maintenance record.
     */
    public function store(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'type' => 'required|in:scheduled,repair,inspection,other',
            'scheduled_date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'nullable|numeric|min:0',
            'service_provider' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'next_maintenance_date' => 'nullable|date',
        ]);

        // Verify asset belongs to organization
        $asset = Asset::where('id', $validated['asset_id'])
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        $record = MaintenanceRecord::create([
            'organization_id' => $organization->id,
            'asset_id' => $validated['asset_id'],
            'user_id' => auth()->id(),
            'type' => $validated['type'],
            'scheduled_date' => $validated['scheduled_date'],
            'status' => 'pending',
            'description' => $validated['description'],
            'cost' => $validated['cost'] ?? null,
            'service_provider' => $validated['service_provider'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'next_maintenance_date' => $validated['next_maintenance_date'] ?? null,
        ]);

        return $this->respond([
            'message' => 'Maintenance record created successfully.',
            'record' => $record->load(['asset', 'user']),
        ], null, [], 201);
    }

    /**
     * Display the specified maintenance record.
     */
    public function show(MaintenanceRecord $maintenanceRecord)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $maintenanceRecord->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $maintenanceRecord->load(['asset', 'user']);

        return $this->respond(
            ['record' => $maintenanceRecord],
            'maintenance.show',
            ['record' => $maintenanceRecord]
        );
    }

    /**
     * Show the form for editing the specified maintenance record.
     */
    public function edit(MaintenanceRecord $maintenanceRecord)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $maintenanceRecord->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $assets = Asset::where('organization_id', $organization->id)
            ->where('status', '!=', 'retired')
            ->orderBy('name')
            ->get();

        return $this->respond(
            [
                'record' => $maintenanceRecord->load('asset'),
                'assets' => $assets,
            ],
            'maintenance.edit',
            [
                'record' => $maintenanceRecord->load('asset'),
                'assets' => $assets,
            ]
        );
    }

    /**
     * Update the specified maintenance record.
     */
    public function update(Request $request, MaintenanceRecord $maintenanceRecord)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $maintenanceRecord->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'type' => 'required|in:scheduled,repair,inspection,other',
            'scheduled_date' => 'required|date',
            'completed_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'description' => 'required|string',
            'work_performed' => 'nullable|string',
            'cost' => 'nullable|numeric|min:0',
            'service_provider' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'next_maintenance_date' => 'nullable|date',
        ]);

        // Verify asset belongs to organization
        $asset = Asset::where('id', $validated['asset_id'])
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        // Auto-set completed_date if status is completed
        if ($validated['status'] === 'completed' && !isset($validated['completed_date'])) {
            $validated['completed_date'] = now();
        }

        $maintenanceRecord->update($validated);

        return $this->respond([
            'message' => 'Maintenance record updated successfully.',
            'record' => $maintenanceRecord->fresh()->load(['asset', 'user']),
        ]);
    }

    /**
     * Remove the specified maintenance record.
     */
    public function destroy(MaintenanceRecord $maintenanceRecord)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $maintenanceRecord->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $maintenanceRecord->delete();

        return $this->respond([
            'message' => 'Maintenance record deleted successfully.',
        ]);
    }

    /**
     * Get upcoming maintenance (next 7 days)
     */
    public function upcoming()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $records = MaintenanceRecord::where('organization_id', $organization->id)
            ->where('status', 'pending')
            ->where('scheduled_date', '>=', now())
            ->where('scheduled_date', '<=', now()->addDays(7))
            ->with(['asset'])
            ->orderBy('scheduled_date', 'asc')
            ->get();

        return $this->respond(
            ['records' => $records],
            'maintenance.upcoming',
            ['records' => $records]
        );
    }
}
