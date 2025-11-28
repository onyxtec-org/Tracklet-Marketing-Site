<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseCategoryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of expense categories.
     */
    public function index()
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $categories = ExpenseCategory::where('organization_id', $organization->id)
            ->orderBy('name')
            ->get();

        return $this->respond(
            ['categories' => $categories],
            'expenses.categories.index',
            ['categories' => $categories]
        );
    }

    /**
     * Store a newly created expense category.
     */
    public function store(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,NULL,id,organization_id,' . $organization->id,
            'description' => 'nullable|string',
        ]);

        $category = ExpenseCategory::create([
            'organization_id' => $organization->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_system' => false,
        ]);

        return $this->respond([
            'message' => 'Expense category created successfully.',
            'category' => $category,
        ], null, [], 201);
    }

    /**
     * Update the specified expense category.
     */
    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expenseCategory->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        if ($expenseCategory->is_system) {
            return $this->respondError('System categories cannot be modified.', 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:expense_categories,name,' . $expenseCategory->id . ',id,organization_id,' . $organization->id,
            'description' => 'nullable|string',
        ]);

        $expenseCategory->update($validated);

        return $this->respond([
            'message' => 'Expense category updated successfully.',
            'category' => $expenseCategory->fresh(),
        ]);
    }

    /**
     * Remove the specified expense category.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expenseCategory->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        if ($expenseCategory->is_system) {
            return $this->respondError('System categories cannot be deleted.', 403);
        }

        // Check if category has expenses
        if ($expenseCategory->expenses()->count() > 0) {
            return $this->respondError('Cannot delete category with existing expenses.', 400);
        }

        $expenseCategory->delete();

        return $this->respond([
            'message' => 'Expense category deleted successfully.',
        ]);
    }
}
