<?php

namespace App\Http\Controllers;

use App\Models\SurveyProvider;
use App\Models\SurveyProjectPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function create()
    {
        return view('vendor.survey.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'survey_types' => 'required|array|min:1',
            'survey_types.*' => 'string',

            'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'aadhar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'license_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            'previous_project_photos' => 'nullable|array',
            'previous_project_photos.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        DB::beginTransaction();

        try {
            $surveyProvider = new SurveyProvider();
            $surveyProvider->survey_types = $request->survey_types;
            $surveyProvider->licensed_certified = $request->has('licensed_certified') ? 1 : 0;
            $surveyProvider->stamped_drawings = $request->has('stamped_drawings') ? 1 : 0;
            $surveyProvider->report_format_available = $request->has('report_format_available') ? 1 : 0;
            $surveyProvider->land_record_support = $request->has('land_record_support') ? 1 : 0;
            $surveyProvider->status = 'pending';

            if ($request->hasFile('gst_certificate')) {
                $surveyProvider->gst_certificate = $request->file('gst_certificate')
                    ->store('survey_documents/gst_certificate', 'public');
            }

            if ($request->hasFile('aadhar_card')) {
                $surveyProvider->aadhar_card = $request->file('aadhar_card')
                    ->store('survey_documents/aadhar_card', 'public');
            }

            if ($request->hasFile('company_profile')) {
                $surveyProvider->company_profile = $request->file('company_profile')
                    ->store('survey_documents/company_profile', 'public');
            }

            if ($request->hasFile('license_certificate')) {
                $surveyProvider->license_certificate = $request->file('license_certificate')
                    ->store('survey_documents/license_certificate', 'public');
            }

            $surveyProvider->save();

            if ($request->hasFile('previous_project_photos')) {
                foreach ($request->file('previous_project_photos') as $photo) {
                    $photoPath = $photo->store('survey_documents/project_photos', 'public');

                    SurveyProjectPhoto::create([
                        'survey_provider_id' => $surveyProvider->id,
                        'photo_path' => $photoPath,
                        'created_at' => now(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Survey Partner registration submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}