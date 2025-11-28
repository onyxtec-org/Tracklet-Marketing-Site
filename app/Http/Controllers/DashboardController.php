<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\InventoryItem;
use App\Models\Asset;
use App\Models\MaintenanceRecord;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Carbon\Carbon;

class DashboardController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $breadcrumbs = [
            ['link'=>"/",'name'=>"Dashboard"], ['name'=>"Dashboard"]
        ];

        $user = auth()->user();
        $organization = $user->organization ?? null;
        
        $trialInfo = null;
        $financialSnapshot = null;
        $inventoryStatus = null;
        $assetSummary = null;
        $upcomingMaintenance = null;
        $expenseCharts = null;
        
        if ($organization) {
            $trialInfo = [
                'is_on_trial' => $organization->isOnTrial(),
                'trial_days_remaining' => $organization->trialDaysRemaining(),
                'trial_ends_at' => $organization->trial_ends_at,
            ];

            // Financial Snapshot (for Finance role or Admin)
            if ($user->hasAnyRole(['admin', 'finance'])) {
                $currentMonth = Expense::where('organization_id', $organization->id)
                    ->whereMonth('expense_date', now()->month)
                    ->whereYear('expense_date', now()->year)
                    ->sum('amount');

                $previousMonth = Expense::where('organization_id', $organization->id)
                    ->whereMonth('expense_date', now()->subMonth()->month)
                    ->whereYear('expense_date', now()->subMonth()->year)
                    ->sum('amount');

                // Top 5 expense categories
                $topCategories = Expense::where('organization_id', $organization->id)
                    ->whereMonth('expense_date', now()->month)
                    ->whereYear('expense_date', now()->year)
                    ->with('category')
                    ->get()
                    ->groupBy('expense_category_id')
                    ->map(function ($expenses) {
                        return [
                            'category' => $expenses->first()->category->name,
                            'amount' => $expenses->sum('amount'),
                        ];
                    })
                    ->sortByDesc('amount')
                    ->take(5)
                    ->values();

                $financialSnapshot = [
                    'current_month' => $currentMonth,
                    'previous_month' => $previousMonth,
                    'change' => $previousMonth > 0 ? (($currentMonth - $previousMonth) / $previousMonth) * 100 : 0,
                    'top_categories' => $topCategories,
                ];
            }

            // Inventory Status (for Admin Support role or Admin)
            if ($user->hasAnyRole(['admin', 'admin_support'])) {
                $lowStockItems = InventoryItem::where('organization_id', $organization->id)
                    ->whereRaw('quantity <= minimum_threshold')
                    ->orderBy('quantity', 'asc')
                    ->take(10)
                    ->get();

                $inventoryStatus = [
                    'low_stock_count' => InventoryItem::where('organization_id', $organization->id)
                        ->whereRaw('quantity <= minimum_threshold')
                        ->count(),
                    'low_stock_items' => $lowStockItems,
                ];
            }

            // Asset & Maintenance Summary (for Admin Support role or Admin)
            if ($user->hasAnyRole(['admin', 'admin_support'])) {
                $totalAssets = Asset::where('organization_id', $organization->id)->count();
                $activeAssets = Asset::where('organization_id', $organization->id)
                    ->where('status', 'active')
                    ->count();
                $inRepairAssets = Asset::where('organization_id', $organization->id)
                    ->where('status', 'in_repair')
                    ->count();

                $upcomingMaintenance = MaintenanceRecord::where('organization_id', $organization->id)
                    ->where('status', 'pending')
                    ->where('scheduled_date', '>=', now())
                    ->where('scheduled_date', '<=', now()->addDays(7))
                    ->with('asset')
                    ->orderBy('scheduled_date', 'asc')
                    ->get();

                $assetSummary = [
                    'total' => $totalAssets,
                    'active' => $activeAssets,
                    'in_repair' => $inRepairAssets,
                    'upcoming_maintenance_count' => $upcomingMaintenance->count(),
                ];
            }

            // Expense Charts Data (for Finance role or Admin)
            if ($user->hasAnyRole(['admin', 'finance'])) {
                // Quarterly expense data for charts
                $currentQuarter = ceil(now()->month / 3);
                $startMonth = ($currentQuarter - 1) * 3 + 1;
                $startDate = Carbon::create(now()->year, $startMonth, 1)->startOfMonth();
                $endDate = $startDate->copy()->addMonths(2)->endOfMonth();

                $quarterlyExpenses = Expense::where('organization_id', $organization->id)
                    ->whereBetween('expense_date', [$startDate, $endDate])
                    ->with('category')
                    ->get();

                // Category breakdown for pie chart
                $categoryBreakdown = $quarterlyExpenses->groupBy('expense_category_id')
                    ->map(function ($expenses) {
                        return [
                            'category' => $expenses->first()->category->name,
                            'amount' => $expenses->sum('amount'),
                        ];
                    })
                    ->sortByDesc('amount')
                    ->values();

                // Monthly trend for line chart
                $monthlyTrend = [];
                for ($i = 2; $i >= 0; $i--) {
                    $month = $startDate->copy()->addMonths($i);
                    $monthExpenses = Expense::where('organization_id', $organization->id)
                        ->whereMonth('expense_date', $month->month)
                        ->whereYear('expense_date', $month->year)
                        ->sum('amount');
                    
                    $monthlyTrend[] = [
                        'month' => $month->format('M Y'),
                        'amount' => $monthExpenses,
                    ];
                }

                $expenseCharts = [
                    'category_breakdown' => $categoryBreakdown,
                    'monthly_trend' => $monthlyTrend,
                ];
            }
        }

        return $this->respond(
            [
                'trial_info' => $trialInfo,
                'financial_snapshot' => $financialSnapshot,
                'inventory_status' => $inventoryStatus,
                'asset_summary' => $assetSummary,
                'upcoming_maintenance' => $upcomingMaintenance,
                'expense_charts' => $expenseCharts,
            ],
            'dashboard',
            [
                'breadcrumbs' => $breadcrumbs,
                'trialInfo' => $trialInfo,
                'organization' => $organization,
                'financialSnapshot' => $financialSnapshot,
                'inventoryStatus' => $inventoryStatus,
                'assetSummary' => $assetSummary,
                'upcomingMaintenance' => $upcomingMaintenance,
                'expenseCharts' => $expenseCharts,
            ]
        );
    }
}
