<?php

namespace App\Http\Controllers;

use App\Models\FabricationServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FabricationServiceController extends Controller
{
    public function create()
    {
        return view('vendor.category.welding-fabrication');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_types' => 'required|array|min:1',
            'service_types.*' => 'string',

            'service_models' => 'required|array|min:1',
            'service_models.*' => 'string',

            'project_types_handled' => 'required|array|min:1',
            'project_types_handled.*' => 'string',

            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'udyam_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'service_types.required' => 'Please select at least one service type.',
            'service_models.required' => 'Please select at least one service model.',
            'project_types_handled.required' => 'Please select at least one project type.',
        ]);

        DB::beginTransaction();

        try {
            $provider = new FabricationServiceProvider();

            $provider->service_types = $request->service_types;
            $provider->service_models = $request->service_models;
            $provider->project_types_handled = $request->project_types_handled;
            $provider->status = 'pending';

            if ($request->hasFile('company_profile')) {
                $provider->company_profile = $request->file('company_profile')
                    ->store('fabrication/company_profile', 'public');
            }

            if ($request->hasFile('gst_certificate')) {
                $provider->gst_certificate = $request->file('gst_certificate')
                    ->store('fabrication/gst_certificate', 'public');
            }

            if ($request->hasFile('aadhaar_card')) {
                $provider->aadhaar_card = $request->file('aadhaar_card')
                    ->store('fabrication/aadhaar_card', 'public');
            }

            if ($request->hasFile('udyam_certificate')) {
                $provider->udyam_certificate = $request->file('udyam_certificate')
                    ->store('fabrication/udyam_certificate', 'public');
            }

            $provider->save();

            DB::commit();

            return redirect()->back()->with('success', 'Fabrication service provider form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}