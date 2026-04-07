<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FacadeServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacadeServicesController extends Controller
{
    public function create()
    {
        return view('vendor.category.facade-services');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_types' => 'required|array|min:1',
            'service_types.*' => 'string',

            'service_models' => 'required|array|min:1',
            'service_models.*' => 'string',

            'building_types' => 'required|array|min:1',
            'building_types.*' => 'string',

            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'safety_certifications' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'quality_certifications' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'service_types.required' => 'Please select at least one service type.',
            'service_models.required' => 'Please select at least one service model.',
            'building_types.required' => 'Please select at least one building type.',
        ]);

        DB::beginTransaction();

        try {
            $provider = new FacadeServiceProvider();

            $provider->service_types = $request->service_types;
            $provider->service_models = $request->service_models;
            $provider->building_types = $request->building_types;
            $provider->status = 'pending';

            if ($request->hasFile('company_profile')) {
                $provider->company_profile = $request->file('company_profile')
                    ->store('facade/company_profile', 'public');
            }

            if ($request->hasFile('gst_certificate')) {
                $provider->gst_certificate = $request->file('gst_certificate')
                    ->store('facade/gst_certificate', 'public');
            }

            if ($request->hasFile('aadhaar_card')) {
                $provider->aadhaar_card = $request->file('aadhaar_card')
                    ->store('facade/aadhaar_card', 'public');
            }

            if ($request->hasFile('safety_certifications')) {
                $provider->safety_certifications = $request->file('safety_certifications')
                    ->store('facade/safety_certifications', 'public');
            }

            if ($request->hasFile('quality_certifications')) {
                $provider->quality_certifications = $request->file('quality_certifications')
                    ->store('facade/quality_certifications', 'public');
            }

            $provider->save();

            DB::commit();

            return redirect()->back()->with('success', 'Façade partner form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}