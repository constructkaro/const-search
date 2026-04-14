<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// change these model names according to your actual models
use App\Models\ContractorProvider;
use App\Models\InteriorProvider;
use App\Models\SurveyProvider;
use App\Models\TestingEnquiry;
use App\Models\BoqEnquiry;

class OrderController extends Controller
{
    public function index()
    {
        $contractorOrders = class_exists(\App\Models\ContractorProvider::class) ? ContractorProvider::latest()->get() : collect();
        $interiorOrders   = class_exists(\App\Models\InteriorProvider::class) ? InteriorProvider::latest()->get() : collect();
        $surveyOrders     = class_exists(\App\Models\SurveyProvider::class) ? SurveyProvider::latest()->get() : collect();
        $testingOrders    = class_exists(\App\Models\TestingEnquiry::class) ? TestingEnquiry::latest()->get() : collect();
        $boqOrders        = class_exists(\App\Models\BoqEnquiry::class) ? BoqEnquiry::latest()->get() : collect();

        $pageTitle = 'All Orders';

        return view('admin.orders.all', compact(
            'pageTitle',
            'contractorOrders',
            'interiorOrders',
            'surveyOrders',
            'testingOrders',
            'boqOrders'
        ));
    }

    public function contractorOrders()
    {
        $orders = ContractorProvider::latest()->get();
        $pageTitle = 'Contractor Orders';

        return view('admin.orders.contractor', compact('orders', 'pageTitle'));
    }

    public function interiorOrders()
    {
        $orders = InteriorProvider::latest()->get();
        $pageTitle = 'Interior Orders';

        return view('admin.orders.interior', compact('orders', 'pageTitle'));
    }

    public function surveyOrders()
    {
        $orders = SurveyOrder::latest()->get();
        $pageTitle = 'Survey Orders';

        return view('admin.orders.survey', compact('orders', 'pageTitle'));
    }

    public function testingOrders()
    {
        $orders = TestingOrder::latest()->get();
        $pageTitle = 'Testing Orders';

        return view('admin.orders.testing', compact('orders', 'pageTitle'));
    }

    public function boqOrders()
    {
        $orders = BoqOrder::latest()->get();
        $pageTitle = 'BOQ Orders';

        return view('admin.orders.boq', compact('orders', 'pageTitle'));
    }
}