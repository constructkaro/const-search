<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SurveyorProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyorController extends Controller
{
    public function create()
    {
        return view('vendor.category.surveyor-registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'survey_types' => 'required|array|min:1',
            'survey_types.*' => 'string',

            'experience_years' => 'required|string|max:100',
            'team_size' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'region' => 'required|string|max:100',
            'city' => 'required|string|max:100',

            'company_name' => 'required|string|max:255',
            'entity_type' => 'required|string|max:100',
            'registered_address' => 'required|string',
            'contact_person_name' => 'required|string|max:150',
            'contact_person_designation' => 'required|string|max:150',

            'licensed_surveyor' => 'nullable|in:Yes,No',
            'stamped_drawings' => 'nullable|in:Yes,No',
            'report_format_available' => 'nullable|in:Yes,No',
            'land_record_support' => 'nullable|in:Yes,No',

            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
            'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
            'license_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
            'previous_project_photos' => 'nullable|file|mimes:pdf,jpg,jpeg,png,zip|max:20480',
        ]);

        DB::beginTransaction();

        try {
            $provider = new SurveyorProvider();

            $provider->survey_types = $request->survey_types;
            $provider->experience_years = $request->experience_years;
            $provider->team_size = $request->team_size;
            $provider->state = $request->state;
            $provider->region = $request->region;
            $provider->city = $request->city;

            $provider->company_name = $request->company_name;
            $provider->entity_type = $request->entity_type;
            $provider->registered_address = $request->registered_address;
            $provider->contact_person_name = $request->contact_person_name;
            $provider->contact_person_designation = $request->contact_person_designation;

            $provider->licensed_surveyor = $request->licensed_surveyor;
            $provider->stamped_drawings = $request->stamped_drawings;
            $provider->report_format_available = $request->report_format_available;
            $provider->land_record_support = $request->land_record_support;

            if ($request->hasFile('gst_certificate')) {
                $provider->gst_certificate = $request->file('gst_certificate')->store('surveyor/gst', 'public');
            }
            if ($request->hasFile('aadhaar_card')) {
                $provider->aadhaar_card = $request->file('aadhaar_card')->store('surveyor/aadhaar', 'public');
            }
            if ($request->hasFile('company_profile')) {
                $provider->company_profile = $request->file('company_profile')->store('surveyor/company_profile', 'public');
            }
            if ($request->hasFile('license_certificate')) {
                $provider->license_certificate = $request->file('license_certificate')->store('surveyor/license', 'public');
            }
            if ($request->hasFile('previous_project_photos')) {
                $provider->previous_project_photos = $request->file('previous_project_photos')->store('surveyor/project_photos', 'public');
            }

            $provider->status = 'pending';
            $provider->save();

            DB::commit();

            return redirect()->back()->with('success', 'Surveyor form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
        }
    }
}