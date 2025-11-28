<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\StockTransaction;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of inventory items.
     */
    public function index(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $query = InventoryItem::where('organization_id', $organization->id);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Filter low stock items
        if ($request->has('low_stock') && $request->low_stock) {
            $query->whereRaw('quantity <= minimum_threshold');
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $items = $query->orderBy('name')->paginate(20);

        // Get all categories for filter
        $categories = InventoryItem::where('organization_id', $organization->id)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->sort()
            ->values();

        // Get low stock items count
        $lowStockCount = InventoryItem::where('organization_id', $organization->id)
            ->whereRaw('quantity <= minimum_threshold')
            ->count();

        return $this->respond(
            [
                'items' => $items,
                'categories' => $categories,
                'low_stock_count' => $lowStockCount,
                'filters' => $request->only(['category', 'low_stock', 'search']),
            ],
            'inventory.index',
            [
                'items' => $items,
                'categories' => $categories,
                'low_stock_count' => $lowStockCount,
                'filters' => $request->only(['category', 'low_stock', 'search']),
            ]
        );
    }

    /**
     * Show the form for creating a new inventory item.
     */
    public function create()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        return $this->respond(
            null,
            'inventory.create'
        );
    }

    /**
     * Store a newly created inventory item.
     */
    public function store(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_threshold' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        $item = new InventoryItem($validated);
        $item->organization_id = $organization->id;
        $item->calculateTotalPrice();
        $item->save();

        return $this->respond([
            'message' => 'Inventory item created successfully.',
            'item' => $item,
        ], null, [], 201);
    }

    /**
     * Display the specified inventory item.
     */
    public function show(InventoryItem $inventoryItem)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $inventoryItem->load(['stockTransactions.user']);

        return $this->respond(
            ['item' => $inventoryItem],
            'inventory.show',
            ['item' => $inventoryItem]
        );
    }

    /**
     * Show the form for editing the specified inventory item.
     */
    public function edit(InventoryItem $inventoryItem)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        return $this->respond(
            ['item' => $inventoryItem],
            'inventory.edit',
            ['item' => $inventoryItem]
        );
    }

    /**
     * Update the specified inventory item.
     */
    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_threshold' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
        ]);

        $inventoryItem->fill($validated);
        $inventoryItem->calculateTotalPrice();
        $inventoryItem->save();

        return $this->respond([
            'message' => 'Inventory item updated successfully.',
            'item' => $inventoryItem->fresh(),
        ]);
    }

    /**
     * Remove the specified inventory item.
     */
    public function destroy(InventoryItem $inventoryItem)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $inventoryItem->delete();

        return $this->respond([
            'message' => 'Inventory item deleted successfully.',
        ]);
    }

    /**
     * Log stock transaction (in or out)
     */
    public function logStock(Request $request, InventoryItem $inventoryItem)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $validated = $request->validate([
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'reference' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'unit_price' => 'nullable|numeric|min:0', // For stock in
            'vendor' => 'nullable|string|max:255', // For stock in
        ]);

        DB::beginTransaction();
        try {
            // Create stock transaction
            $transaction = StockTransaction::create([
                'organization_id' => $organization->id,
                'inventory_item_id' => $inventoryItem->id,
                'user_id' => auth()->id(),
                'type' => $validated['type'],
                'quantity' => $validated['quantity'],
                'transaction_date' => $validated['transaction_date'],
                'reference' => $validated['reference'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'unit_price' => $validated['unit_price'] ?? null,
                'vendor' => $validated['vendor'] ?? null,
            ]);

            // Update inventory item quantity
            if ($validated['type'] === 'in') {
                $inventoryItem->quantity += $validated['quantity'];
                // Update unit price if provided
                if (isset($validated['unit_price'])) {
                    $inventoryItem->unit_price = $validated['unit_price'];
                }
            } else {
                $inventoryItem->quantity -= $validated['quantity'];
                if ($inventoryItem->quantity < 0) {
                    throw new \Exception('Insufficient stock. Available: ' . ($inventoryItem->quantity + $validated['quantity']));
                }
            }

            $inventoryItem->calculateTotalPrice();
            $inventoryItem->save();

            DB::commit();

            return $this->respond([
                'message' => 'Stock transaction logged successfully.',
                'transaction' => $transaction->load('user'),
                'item' => $inventoryItem->fresh(),
            ], null, [], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError('Failed to log stock transaction: ' . $e->getMessage(), 400);
        }
    }

    /**
     * Get stock transactions for an item
     */
    public function stockTransactions(InventoryItem $inventoryItem, Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $inventoryItem->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $query = $inventoryItem->stockTransactions()->with('user');

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('transaction_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('transaction_date', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(20);

        return $this->respond(
            [
                'item' => $inventoryItem,
                'transactions' => $transactions,
            ],
            'inventory.transactions',
            [
                'item' => $inventoryItem,
                'transactions' => $transactions,
            ]
        );
    }

    /**
     * Get low stock items
     */
    public function lowStock()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $items = InventoryItem::where('organization_id', $organization->id)
            ->whereRaw('quantity <= minimum_threshold')
            ->orderBy('quantity', 'asc')
            ->get();

        return $this->respond(
            ['items' => $items],
            'inventory.low-stock',
            ['items' => $items]
        );
    }

    /**
     * Get purchase history (stock in transactions)
     */
    public function purchaseHistory(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $query = StockTransaction::where('organization_id', $organization->id)
            ->where('type', 'in')
            ->with(['inventoryItem', 'user']);

        if ($request->has('item_id') && $request->item_id) {
            $query->where('inventory_item_id', $request->item_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('transaction_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('transaction_date', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->paginate(20);

        return $this->respond(
            ['transactions' => $transactions],
            'inventory.purchase-history',
            ['transactions' => $transactions]
        );
    }

    /**
     * Get item aging report
     */
    public function agingReport()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $items = InventoryItem::where('organization_id', $organization->id)
            ->where('quantity', '>', 0)
            ->get()
            ->map(function ($item) {
                $oldestDate = $item->getOldestStockDate();
                $ageInDays = Carbon::parse($oldestDate)->diffInDays(now());
                
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'category' => $item->category,
                    'quantity' => $item->quantity,
                    'oldest_stock_date' => $oldestDate,
                    'age_in_days' => $ageInDays,
                ];
            })
            ->sortByDesc('age_in_days')
            ->values();

        return $this->respond(
            ['items' => $items],
            'inventory.aging-report',
            ['items' => $items]
        );
    }
}
