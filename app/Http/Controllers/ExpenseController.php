<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of expenses.
     */
    public function index(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $query = Expense::where('organization_id', $organization->id)
            ->with(['category', 'user'])
            ->orderBy('expense_date', 'desc');

        // Apply filters
        if ($request->has('category_id') && $request->category_id) {
            $query->where('expense_category_id', $request->category_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('expense_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('expense_date', '<=', $request->date_to);
        }

        if ($request->has('vendor') && $request->vendor) {
            $query->where('vendor_payee', 'like', '%' . $request->vendor . '%');
        }

        $expenses = $query->paginate(20);

        $categories = ExpenseCategory::where('organization_id', $organization->id)
            ->orderBy('name')
            ->get();

        return $this->respond(
            [
                'expenses' => $expenses,
                'categories' => $categories,
                'filters' => $request->only(['category_id', 'date_from', 'date_to', 'vendor']),
            ],
            'expenses.index',
            [
                'expenses' => $expenses,
                'categories' => $categories,
                'filters' => $request->only(['category_id', 'date_from', 'date_to', 'vendor']),
            ]
        );
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create()
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
            'expenses.create',
            ['categories' => $categories]
        );
    }

    /**
     * Store a newly created expense.
     */
    public function store(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'vendor_payee' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        // Verify category belongs to organization
        $category = ExpenseCategory::where('id', $validated['expense_category_id'])
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store(
                'expenses/receipts/' . $organization->id,
                'public'
            );
        }

        $expense = Expense::create([
            'organization_id' => $organization->id,
            'expense_category_id' => $validated['expense_category_id'],
            'user_id' => auth()->id(),
            'expense_date' => $validated['expense_date'],
            'amount' => $validated['amount'],
            'vendor_payee' => $validated['vendor_payee'] ?? null,
            'description' => $validated['description'] ?? null,
            'receipt_path' => $receiptPath,
        ]);

        return $this->respond([
            'message' => 'Expense created successfully.',
            'expense' => $expense->load(['category', 'user']),
        ], null, [], 201);
    }

    /**
     * Display the specified expense.
     */
    public function show(Expense $expense)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expense->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $expense->load(['category', 'user']);

        return $this->respond(
            ['expense' => $expense],
            'expenses.show',
            ['expense' => $expense]
        );
    }

    /**
     * Show the form for editing the specified expense.
     */
    public function edit(Expense $expense)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expense->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $categories = ExpenseCategory::where('organization_id', $organization->id)
            ->orderBy('name')
            ->get();

        return $this->respond(
            [
                'expense' => $expense->load(['category']),
                'categories' => $categories,
            ],
            'expenses.edit',
            [
                'expense' => $expense->load(['category']),
                'categories' => $categories,
            ]
        );
    }

    /**
     * Update the specified expense.
     */
    public function update(Request $request, Expense $expense)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expense->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        $validated = $request->validate([
            'expense_category_id' => 'required|exists:expense_categories,id',
            'expense_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'vendor_payee' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Verify category belongs to organization
        $category = ExpenseCategory::where('id', $validated['expense_category_id'])
            ->where('organization_id', $organization->id)
            ->firstOrFail();

        // Handle receipt upload
        if ($request->hasFile('receipt')) {
            // Delete old receipt if exists
            if ($expense->receipt_path) {
                Storage::disk('public')->delete($expense->receipt_path);
            }
            
            $receiptPath = $request->file('receipt')->store(
                'expenses/receipts/' . $organization->id,
                'public'
            );
            $validated['receipt_path'] = $receiptPath;
        }

        $expense->update($validated);

        return $this->respond([
            'message' => 'Expense updated successfully.',
            'expense' => $expense->fresh()->load(['category', 'user']),
        ]);
    }

    /**
     * Remove the specified expense.
     */
    public function destroy(Expense $expense)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization || $expense->organization_id !== $organization->id) {
            return $this->respondError('Unauthorized access.', 403);
        }

        // Delete receipt file if exists
        if ($expense->receipt_path) {
            Storage::disk('public')->delete($expense->receipt_path);
        }

        $expense->delete();

        return $this->respond([
            'message' => 'Expense deleted successfully.',
        ]);
    }

    /**
     * Get expense reports (monthly, quarterly, YTD)
     */
    public function reports(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $period = $request->get('period', 'monthly'); // monthly, quarterly, ytd
        $year = $request->get('year', date('Y'));

        $query = Expense::where('organization_id', $organization->id);

        switch ($period) {
            case 'monthly':
                $month = $request->get('month', date('m'));
                $startDate = Carbon::create($year, $month, 1)->startOfMonth();
                $endDate = $startDate->copy()->endOfMonth();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;

            case 'quarterly':
                $quarter = $request->get('quarter', ceil(date('m') / 3));
                $startMonth = ($quarter - 1) * 3 + 1;
                $startDate = Carbon::create($year, $startMonth, 1)->startOfMonth();
                $endDate = $startDate->copy()->addMonths(2)->endOfMonth();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;

            case 'ytd':
                $startDate = Carbon::create($year, 1, 1)->startOfYear();
                $endDate = Carbon::now();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;
        }

        $expenses = $query->with('category')->get();

        // Calculate totals by category
        $categoryTotals = $expenses->groupBy('expense_category_id')
            ->map(function ($items) {
                return [
                    'category' => $items->first()->category->name,
                    'total' => $items->sum('amount'),
                    'count' => $items->count(),
                ];
            })
            ->sortByDesc('total')
            ->values();

        $totalAmount = $expenses->sum('amount');
        $totalCount = $expenses->count();

        return $this->respond([
            'period' => $period,
            'year' => $year,
            'total_amount' => $totalAmount,
            'total_count' => $totalCount,
            'category_totals' => $categoryTotals,
            'expenses' => $expenses,
        ], 'expenses.reports', [
            'period' => $period,
            'year' => $year,
            'total_amount' => $totalAmount,
            'total_count' => $totalCount,
            'category_totals' => $categoryTotals,
            'expenses' => $expenses,
        ]);
    }

    /**
     * Get expense charts data
     */
    public function charts(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $period = $request->get('period', 'monthly');
        $year = $request->get('year', date('Y'));

        $query = Expense::where('organization_id', $organization->id);

        switch ($period) {
            case 'monthly':
                $month = $request->get('month', date('m'));
                $startDate = Carbon::create($year, $month, 1)->startOfMonth();
                $endDate = $startDate->copy()->endOfMonth();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;

            case 'quarterly':
                $quarter = $request->get('quarter', ceil(date('m') / 3));
                $startMonth = ($quarter - 1) * 3 + 1;
                $startDate = Carbon::create($year, $startMonth, 1)->startOfMonth();
                $endDate = $startDate->copy()->addMonths(2)->endOfMonth();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;

            case 'ytd':
                $startDate = Carbon::create($year, 1, 1)->startOfYear();
                $endDate = Carbon::now();
                $query->whereBetween('expense_date', [$startDate, $endDate]);
                break;
        }

        $expenses = $query->with('category')->get();

        // Bar Chart Data (Category breakdown)
        $barChartData = $expenses->groupBy('expense_category_id')
            ->map(function ($items, $categoryId) {
                return [
                    'category' => $items->first()->category->name,
                    'amount' => $items->sum('amount'),
                ];
            })
            ->sortByDesc('amount')
            ->values();

        // Line Chart Data (Trend over time)
        $lineChartData = $expenses->groupBy(function ($expense) {
            return $expense->expense_date->format('Y-m-d');
        })->map(function ($items, $date) {
            return [
                'date' => $date,
                'amount' => $items->sum('amount'),
            ];
        })->sortBy('date')->values();

        // Pie Chart Data (Category percentage)
        $totalAmount = $expenses->sum('amount');
        $pieChartData = $expenses->groupBy('expense_category_id')
            ->map(function ($items) use ($totalAmount) {
                $amount = $items->sum('amount');
                return [
                    'category' => $items->first()->category->name,
                    'amount' => $amount,
                    'percentage' => $totalAmount > 0 ? round(($amount / $totalAmount) * 100, 2) : 0,
                ];
            })
            ->sortByDesc('amount')
            ->values();

        return $this->respond([
            'bar_chart' => $barChartData,
            'line_chart' => $lineChartData,
            'pie_chart' => $pieChartData,
        ]);
    }

    /**
     * Export expenses to Excel/PDF
     */
    public function export(Request $request)
    {
        $organization = auth()->user()->organization;
        
        if (!$organization) {
            return $this->respondError('User does not belong to an organization.', 403);
        }

        $format = $request->get('format', 'excel'); // excel or pdf
        $query = Expense::where('organization_id', $organization->id)
            ->with(['category', 'user']);

        // Apply same filters as index
        if ($request->has('category_id') && $request->category_id) {
            $query->where('expense_category_id', $request->category_id);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->where('expense_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('expense_date', '<=', $request->date_to);
        }

        $expenses = $query->orderBy('expense_date', 'desc')->get();

        // For now, return JSON. In production, use Laravel Excel or DomPDF
        // This is a placeholder - you'll need to install maatwebsite/excel or barryvdh/laravel-dompdf
        return $this->respond([
            'message' => 'Export functionality requires Laravel Excel or DomPDF package.',
            'expenses' => $expenses,
            'format' => $format,
        ]);
    }
}
