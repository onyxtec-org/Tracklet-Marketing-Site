<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'asset_id',
        'user_id',
        'type',
        'scheduled_date',
        'completed_date',
        'status',
        'description',
        'work_performed',
        'cost',
        'service_provider',
        'notes',
        'next_maintenance_date',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date',
        'next_maintenance_date' => 'date',
        'cost' => 'decimal:2',
    ];

    /**
     * Get the organization that owns the maintenance record
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get the asset
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the user who logged/maintained
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if maintenance is upcoming (within next 7 days)
     */
    public function isUpcoming(): bool
    {
        if ($this->status !== 'pending') {
            return false;
        }
        return $this->scheduled_date->isFuture() && 
               $this->scheduled_date->diffInDays(now()) <= 7;
    }
}
