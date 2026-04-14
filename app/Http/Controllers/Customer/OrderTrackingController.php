<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ContractorBooking;
use App\Models\InteriorBooking;
use App\Models\SurveyBooking;
use App\Models\TestingEnquiry;
use App\Models\BoqBooking;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function show($service, $id)
    {
        $modelMap = [
            'contractor' => ContractorBooking::class,
            'interior'   => InteriorBooking::class,
            'survey'     => SurveyBooking::class,
            'testing'    => TestingEnquiry::class,
            'boq'        => BoqBooking::class,
        ];

        if (!array_key_exists($service, $modelMap)) {
            abort(404, 'Invalid service type');
        }

        $modelClass = $modelMap[$service];
        $booking = $modelClass::findOrFail($id);

        $orderSteps = $booking->trackings()
            ->where('tab_type', 'order')
            ->orderBy('step_order')
            ->get();

        $executionSteps = $booking->trackings()
            ->where('tab_type', 'execution')
            ->orderBy('step_order')
            ->get();

        return view('customer.dynamic-order-track', compact(
            'booking',
            'service',
            'orderSteps',
            'executionSteps'
        ));
    }
}