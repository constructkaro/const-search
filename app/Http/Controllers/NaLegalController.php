<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NaLegalProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NaLegalController extends Controller
{
    public function create()
    {
        return view('category.legal-na-support');
    }

    public function store(Request $request)
    {
        $request->validate([
            'services_offered' => 'required|array|min:1',
            'services_offered.*' => 'string',

            'property_types_handled' => 'required|array|min:1',
            'property_types_handled.*' => 'string',

            'complete_na_process' => 'nullable|in:Yes,No',
            'legal_opinion_reports' => 'nullable|in:Yes,No',
            'coordinate_with_advocates' => 'nullable|in:Yes,No',

            'average_turnaround_time' => 'nullable|string|max:255',

            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'registration_license' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'services_offered.required' => 'Please select at least one service.',
            'property_types_handled.required' => 'Please select at least one property type.',
        ]);

        DB::beginTransaction();

        try {
            $provider = new NaLegalProvider();

            $provider->services_offered = $request->services_offered;
            $provider->property_types_handled = $request->property_types_handled;

            $provider->complete_na_process = $request->complete_na_process;
            $provider->legal_opinion_reports = $request->legal_opinion_reports;
            $provider->coordinate_with_advocates = $request->coordinate_with_advocates;
            $provider->average_turnaround_time = $request->average_turnaround_time;

            $provider->status = 'pending';

            if ($request->hasFile('gst_certificate')) {
                $provider->gst_certificate = $request->file('gst_certificate')
                    ->store('na_legal/gst_certificate', 'public');
            }

            if ($request->hasFile('aadhar_card')) {
                $provider->aadhar_card = $request->file('aadhar_card')
                    ->store('na_legal/aadhar_card', 'public');
            }

            if ($request->hasFile('company_profile')) {
                $provider->company_profile = $request->file('company_profile')
                    ->store('na_legal/company_profile', 'public');
            }

            if ($request->hasFile('registration_license')) {
                $provider->registration_license = $request->file('registration_license')
                    ->store('na_legal/registration_license', 'public');
            }

            $provider->save();

            DB::commit();

            return redirect()->back()->with('success', 'NA Support + Legal Due Diligence form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}