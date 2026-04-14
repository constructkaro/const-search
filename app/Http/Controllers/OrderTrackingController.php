<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function show(Order $order)
    {
        $orderSteps = $order->trackingSteps()
            ->where('tab_type', 'order')
            ->orderBy('step_order')
            ->get();

        $executionSteps = $order->trackingSteps()
            ->where('tab_type', 'execution')
            ->orderBy('step_order')
            ->get();

        return view('customer.ordertrack', compact('order', 'orderSteps', 'executionSteps'));
    }
}