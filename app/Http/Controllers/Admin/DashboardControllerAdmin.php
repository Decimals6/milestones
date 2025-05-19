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
                            ->sum('total_price');

    // Top Toppings (most selected food items)
    $topToppings = DB::table('order_detail_options')
        ->join('food_items', 'food_items.id', '=', 'order_detail_options.foods_item_id')
        ->select('food_items.name', DB::raw('COUNT(*) as total'))
        ->groupBy('food_items.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

    // Periode 6 bulan terakhir
    $period = CarbonPeriod::create(
        Carbon::now()->subMonths(5)->startOfMonth(),
        '1 month',
        Carbon::now()->startOfMonth()
    );

    $months = [];
    $monthlyRevenue = [];
    foreach ($period as $dt) {
        $months[] = $dt->format('M Y');
        $monthlyRevenue[] = Order::whereYear('order_time', $dt->year)
            ->whereMonth('order_time', $dt->month)
            ->where('status', 'COMPLETED')
            ->sum('total_price');
    }

    // Trending Foods
    $trendingFoods = DB::table('order_details')
        ->join('foods', 'foods.id', '=', 'order_details.foods_id')
        ->select('foods.name', DB::raw('COUNT(*) AS total'))
        ->groupBy('foods.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

    // Recent Orders
    $recentOrders = Order::with('user')
        ->orderBy('order_time', 'desc')
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
