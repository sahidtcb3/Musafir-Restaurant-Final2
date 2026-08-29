<?php

namespace App\Http\Controllers\Traits;

use App\Models\Order;

trait OrderStatisticsTrait
{
    public function shareOrderStatistics()
    {
        $pending_orders_count = Order::where('status', 'pending')->count();
        $online_orders_count = Order::where('order_type', 'online')->count();
        $instore_orders_count = Order::where('order_type', 'instore')->count();
        $all_orders_count = Order::count();
        $confirmed_orders_count = Order::where('status', 'confirmed')->count();
        $rejected_orders_count = Order::where('status', 'rejected')->count();
        $delivered_orders_count = Order::where('status', 'delivered')->count();

        view()->share([
            'pending_orders_count' => $pending_orders_count,
            'online_orders_count' => $online_orders_count,
            'instore_orders_count' => $instore_orders_count,
            'all_orders_count' => $all_orders_count,
            'confirmed_orders_count' => $confirmed_orders_count,
            'rejected_orders_count' => $rejected_orders_count,
            'delivered_orders_count' => $delivered_orders_count,
        ]);
    }
}
