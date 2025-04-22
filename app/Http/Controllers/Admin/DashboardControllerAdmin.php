<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\CategoryItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardControllerAdmin extends Controller
{
    public function index()
    {
        $totalFoods      = Food::count();
        $totalCategories = CategoryItem::count();
        $totalOrders     = Order::count();
        $totalRevenue    = Order::where('status', 'COMPLETED')
                                ->sum('total_Price');

        // toppings/extra
        $topToppings = DB::table('order_details_options')
            ->join('foods_items', 'foods_items.id', '=', 'order_details_options.food_item_id')
            ->select('foods_items.name', DB::raw('COUNT(*) as total'))
            ->groupBy('foods_items.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // periode
        $period = CarbonPeriod::create(
            Carbon::now()->subMonths(5)->startOfMonth(),
            '1 month',
            Carbon::now()->startOfMonth()
        );

        // omzet
        $months         = [];
        $monthlyRevenue = [];
        foreach ($period as $dt) {
            $months[] = $dt->format('M Y');
            $monthlyRevenue[] = Order::whereYear('order_Time', $dt->year)
                ->whereMonth('order_Time', $dt->month)
                ->where('status', 'COMPLETED')
                ->sum('total_Price');
        }

        // trending
        $trendingFoods = DB::table('order_details')
        ->join('foods', 'foods.id', '=', 'order_details.food_id')
        ->select('foods.name', DB::raw('COUNT(*) AS total'))
        ->groupBy('foods.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        // recent
        $recentOrders = Order::with('user')
            ->orderBy('order_Time','desc')
            ->limit(5)
            ->get();

        return view('admin.page.dashboard', compact(
            'totalFoods',
            'totalCategories',
            'totalOrders',
            'totalRevenue',
            'topToppings',
            'months',
            'monthlyRevenue',
            'trendingFoods',
            'recentOrders'
        ));
    }
}
