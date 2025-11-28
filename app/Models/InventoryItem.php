<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'organization_id',
        'name',
        'category',
        'quantity',
        'minimum_threshold',
        'unit_price',
        'total_price',
        'unit',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'minimum_threshold' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the organization that owns the item
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Get all stock transactions for this item
     */
    public function stockTransactions(): HasMany
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Check if item is low on stock
     */
    public function isLowStock(): bool
    {
        return $this->quantity <= $this->minimum_threshold;
    }

    /**
     * Calculate total price based on quantity and unit price
     */
    public function calculateTotalPrice(): void
    {
        $this->total_price = $this->quantity * $this->unit_price;
    }

    /**
     * Get oldest stock transaction date (for aging report)
     */
    public function getOldestStockDate()
    {
        $oldestIn = $this->stockTransactions()
            ->where('type', 'in')
            ->orderBy('transaction_date', 'asc')
            ->first();

        return $oldestIn ? $oldestIn->transaction_date : $this->created_at;
    }
}
