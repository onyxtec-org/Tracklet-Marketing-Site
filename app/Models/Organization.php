<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'address',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
        'is_subscribed',
        'subscription_ends_at',
        'is_active',
        'registration_source',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'subscription_ends_at' => 'datetime',
        'is_subscribed' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the users for the organization.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the invitations for the organization.
     */
    public function invitations(): HasMany
    {
        return $this->hasMany(OrganizationInvitation::class);
    }

    /**
     * Get the expense categories for the organization.
     */
    public function expenseCategories(): HasMany
    {
        return $this->hasMany(ExpenseCategory::class);
    }

    /**
     * Get the expenses for the organization.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get the inventory items for the organization.
     */
    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }

    /**
     * Get the stock transactions for the organization.
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Get the assets for the organization.
     */
    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    /**
     * Get the asset movements for the organization.
     */
    public function assetMovements(): HasMany
    {
        return $this->hasMany(AssetMovement::class);
    }

    /**
     * Get the maintenance records for the organization.
     */
    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }

    /**
     * Get the admin user for the organization.
     * This is a method, not a relationship, because it uses whereHas which doesn't work well with eager loading.
     */
    public function admin(): ?User
    {
        return $this->users()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->first();
    }

    /**
     * Check if organization is subscribed or in trial period
     */
    public function isSubscribed(): bool
    {
        // Check if in trial period
        if ($this->trial_ends_at && $this->trial_ends_at->isFuture()) {
            return true;
        }

        // Check if subscription is active
        return $this->is_subscribed && 
               ($this->subscription_ends_at === null || $this->subscription_ends_at->isFuture());
    }

    /**
     * Check if organization is in trial period
     */
    public function isOnTrial(): bool
    {
        return $this->trial_ends_at && $this->trial_ends_at->isFuture();
    }

    /**
     * Get days remaining in trial
     */
    public function trialDaysRemaining(): ?int
    {
        if (!$this->isOnTrial()) {
            return null;
        }

        return max(0, now()->diffInDays($this->trial_ends_at, false));
    }
}
