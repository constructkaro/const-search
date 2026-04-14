<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTracking;
use App\Models\OrderTrackingStep;
use App\Models\TrackingTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingTemplateController extends Controller
{
    public function index(Request $request)
    {
        $query = TrackingTemplate::query();

        if ($request->filled('service_key')) {
            $query->where('service_key', $request->service_key);
        }

        if ($request->filled('tab_type')) {
            $query->where('tab_type', $request->tab_type);
        }

        if ($request->filled('template_code')) {
            $query->where('template_code', $request->template_code);
        }

        $templates = $query
            ->orderBy('service_key')
            ->orderBy('template_code')
            ->orderBy('tab_type')
            ->orderBy('step_order')
            ->get();

        $serviceOptions = [
            'survey'     => 'Survey',
            'testing'    => 'Testing',
            'boq'        => 'BOQ / Estimation',
            'contractor' => 'Contractor',
            'interior'   => 'Interior',
        ];

        $templateCodes = TrackingTemplate::select('template_code')
            ->whereNotNull('template_code')
            ->distinct()
            ->orderBy('template_code')
            ->pluck('template_code');

        return view('admin.tracking_templates.index', compact(
            'templates',
            'serviceOptions',
            'templateCodes'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_key'       => 'required|string',
            'template_code'     => 'required|string|max:100',
            'template_name'     => 'required|string|max:150',
            'tab_type'          => 'required|string',
            'step_order'        => 'required|integer|min:1',
            'step_title'        => 'required|string|max:255',
            'step_description'  => 'nullable|string',
            'step_type'         => 'nullable|string|max:100',
            'status_default'    => 'required|string|max:50',
            'button_text'       => 'nullable|string|max:255',
        ]);

        TrackingTemplate::create($request->only([
            'service_key',
            'template_code',
            'template_name',
            'tab_type',
            'step_order',
            'step_title',
            'step_description',
            'step_type',
            'status_default',
            'button_text',
        ]));

        return redirect()->back()->with('success', 'Tracking template step added successfully.');
    }

    public function update(Request $request, $id)
    {
        $template = TrackingTemplate::findOrFail($id);

        $request->validate([
            'service_key'       => 'required|string',
            'template_code'     => 'required|string|max:100',
            'template_name'     => 'required|string|max:150',
            'tab_type'          => 'required|string',
            'step_order'        => 'required|integer|min:1',
            'step_title'        => 'required|string|max:255',
            'step_description'  => 'nullable|string',
            'step_type'         => 'nullable|string|max:100',
            'status_default'    => 'required|string|max:50',
            'button_text'       => 'nullable|string|max:255',
        ]);

        $template->update($request->only([
            'service_key',
            'template_code',
            'template_name',
            'tab_type',
            'step_order',
            'step_title',
            'step_description',
            'step_type',
            'status_default',
            'button_text',
        ]));

        return redirect()->back()->with('success', 'Tracking template updated successfully.');
    }

    public function delete($id)
    {
        $template = TrackingTemplate::findOrFail($id);
        $template->delete();

        return redirect()->back()->with('success', 'Tracking template deleted successfully.');
    }

    public function adminOrders()
    {
        $surveyBookings = DB::table('survey_bookings')->get()->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Survey Booking',
                'service_key' => 'survey',
                'title' => $item->service_name ?? 'Survey Service',
                'location' => $item->full_address ?? '-',
                'created_at' => $item->created_at,
                'source_table' => 'survey_bookings',
            ];
        });

        $testingEnquiries = DB::table('testing_enquiries')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Testing Enquiry',
                'service_key' => 'testing',
                'title' => $item->project_name ?? $item->service_name ?? 'Testing Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'testing_enquiries',
            ];
        });

        $boqEnquiries = DB::table('boq_enquiries')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'BOQ Enquiry',
                'service_key' => 'boq',
                'title' => $item->project_name ?? $item->service_name ?? 'BOQ / Estimation',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'boq_enquiries',
            ];
        });

        $contractorBookings = DB::table('contractor_providers')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Contractor Booking',
                'service_key' => 'contractor',
                'title' => $item->project_name ?? $item->service_name ?? 'Contractor Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'contractor_providers',
            ];
        });

        $interiorBookings = DB::table('interior_providers')->get()->map(function ($item) {
            $location = collect([
                $item->house_building_name ?? null,
                $item->road_area_colony ?? null,
                $item->city ?? null,
                $item->pincode ?? null,
            ])->filter()->implode(', ');

            return (object) [
                'id' => $item->id,
                'customer_id' => $item->customer_id ?? null,
                'type' => 'Interior Booking',
                'service_key' => 'interior',
                'title' => $item->project_name ?? $item->service_name ?? 'Interior Service',
                'location' => $location ?: '-',
                'created_at' => $item->created_at,
                'source_table' => 'interior_providers',
            ];
        });

        $allOrders = collect()
            ->concat($surveyBookings)
            ->concat($testingEnquiries)
            ->concat($boqEnquiries)
            ->concat($contractorBookings)
            ->concat($interiorBookings)
            ->sortByDesc('created_at')
            ->values();

        $templateOptions = TrackingTemplate::select('service_key', 'template_code', 'template_name')
            ->whereNotNull('template_code')
            ->whereNotNull('template_name')
            ->distinct()
            ->orderBy('service_key')
            ->orderBy('template_name')
            ->get()
            ->groupBy('service_key');

        $assignedTrackings = OrderTracking::get()->keyBy(function ($item) {
            return $item->service_key . '_' . $item->source_id;
        });

        return view('admin.order_tracking.index', compact('allOrders', 'templateOptions', 'assignedTrackings'));
    }

  public function assignTemplate(Request $request)
{
    $request->validate([
        'service_key'   => 'required|string',
        'source_id'     => 'required|integer',
        'source_table'  => 'required|string',
        'customer_id'   => 'nullable|integer',
        'template_code' => 'required|string',
    ]);

    $tracking = \App\Models\OrderTracking::updateOrCreate(
        [
            'service_key' => $request->service_key,
            'source_id'   => $request->source_id,
        ],
        [
            'customer_id'   => $request->customer_id,
            'source_table'  => $request->source_table,
            'template_code' => $request->template_code,
            'status'        => 'in_progress',
        ]
    );

    \App\Models\OrderTrackingStep::where('order_tracking_id', $tracking->id)->delete();

    $templates = \App\Models\TrackingTemplate::where('service_key', $request->service_key)
        ->where('template_code', $request->template_code)
        ->orderBy('tab_type')
        ->orderBy('step_order')
        ->get();

    foreach ($templates as $template) {
        \App\Models\OrderTrackingStep::create([
            'order_tracking_id' => $tracking->id,
            'template_id'       => $template->id,
            'service_key'       => $template->service_key,
            'template_code'     => $template->template_code,
            'tab_type'          => $template->tab_type,
            'step_order'        => $template->step_order,
            'step_title'        => $template->step_title,
            'step_description'  => $template->step_description,
            'step_type'         => $template->step_type,
            'status'            => $template->status_default,
            'button_text'       => $template->button_text,
        ]);
    }

    return redirect()->back()->with('success', 'Template assigned successfully.');
}
   

   public function manageSteps($service_key, $source_id)
{
    $tracking = \App\Models\OrderTracking::where('service_key', $service_key)
        ->where('source_id', $source_id)
        ->firstOrFail();

    $steps = \App\Models\OrderTrackingStep::where('order_tracking_id', $tracking->id)
        ->orderBy('tab_type')
        ->orderBy('step_order')
        ->get();

    return view('admin.order_tracking.steps', compact('tracking', 'steps'));
}

public function updateStep(Request $request, $id)
{
    $step = \App\Models\OrderTrackingStep::findOrFail($id);

    $request->validate([
        'status' => 'required|string',
        'input_value' => 'nullable|string',
    ]);

    $step->update([
        'status' => $request->status,
        'input_value' => $request->input_value,
    ]);

    return redirect()->back()->with('success', 'Step updated successfully.');
}
}