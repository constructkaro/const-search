<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ContractorProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractorController extends Controller
{
    public function create()
    {
        return view('vendor.category.contractor-registration');
    }

    // public function store(Request $request)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'project_types' => 'required|array|min:1',
    //         'project_types.*' => 'string',

    //         'experience_years' => 'required|string|max:100',
    //         'team_size' => 'required|string|max:100',
    //         'state' => 'required|string|max:100',
    //         'region' => 'required|string|max:100',
    //         'city' => 'required|string|max:100',
    //         'minimum_project_value' => 'required|numeric',

    //         'company_name' => 'required|string|max:255',
    //         'entity_type' => 'required|string|max:100',
    //         'registered_address' => 'required|string',
    //         'contact_person_designation' => 'required|string|max:150',
    //         'contact_person_name' => 'nullable|string|max:150',

    //         'pan_number' => 'nullable|string|max:50',
    //         'tan_number' => 'nullable|string|max:50',
    //         'esic_number' => 'nullable|string|max:100',
    //         'pf_number' => 'nullable|string|max:100',

    //         'msme_registered' => 'required|in:Yes,No',

    //         'msme_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'pan_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'gst_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'aadhaar_card' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'company_profile' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'pf_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',
    //         'esic_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:20480',

    //         'work_photo_1' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:20480',
    //         'work_photo_2' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:20480',
    //         'work_photo_3' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:20480',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $provider = new ContractorProvider();

    //         $provider->project_types = $request->project_types;
    //         $provider->experience_years = $request->experience_years;
    //         $provider->team_size = $request->team_size;
    //         $provider->state = $request->state;
    //         $provider->region = $request->region;
    //         $provider->city = $request->city;
    //         $provider->minimum_project_value = $request->minimum_project_value;

    //         $provider->company_name = $request->company_name;
    //         $provider->entity_type = $request->entity_type;
    //         $provider->registered_address = $request->registered_address;
    //         $provider->contact_person_designation = $request->contact_person_designation;
    //         $provider->contact_person_name = $request->contact_person_name;

    //         $provider->pan_number = $request->pan_number;
    //         $provider->tan_number = $request->tan_number;
    //         $provider->esic_number = $request->esic_number;
    //         $provider->pf_number = $request->pf_number;
    //         $provider->msme_registered = $request->msme_registered;

    //         if ($request->hasFile('msme_certificate')) {
    //             $provider->msme_certificate = $request->file('msme_certificate')->store('contractor/msme', 'public');
    //         }
    //         if ($request->hasFile('pan_card')) {
    //             $provider->pan_card = $request->file('pan_card')->store('contractor/pan', 'public');
    //         }
    //         if ($request->hasFile('gst_certificate')) {
    //             $provider->gst_certificate = $request->file('gst_certificate')->store('contractor/gst', 'public');
    //         }
    //         if ($request->hasFile('aadhaar_card')) {
    //             $provider->aadhaar_card = $request->file('aadhaar_card')->store('contractor/aadhaar', 'public');
    //         }
    //         if ($request->hasFile('company_profile')) {
    //             $provider->company_profile = $request->file('company_profile')->store('contractor/company_profile', 'public');
    //         }
    //         if ($request->hasFile('pf_doc')) {
    //             $provider->pf_doc = $request->file('pf_doc')->store('contractor/pf_doc', 'public');
    //         }
    //         if ($request->hasFile('esic_doc')) {
    //             $provider->esic_doc = $request->file('esic_doc')->store('contractor/esic_doc', 'public');
    //         }
    //         if ($request->hasFile('work_photo_1')) {
    //             $provider->work_photo_1 = $request->file('work_photo_1')->store('contractor/work_photos', 'public');
    //         }
    //         if ($request->hasFile('work_photo_2')) {
    //             $provider->work_photo_2 = $request->file('work_photo_2')->store('contractor/work_photos', 'public');
    //         }
    //         if ($request->hasFile('work_photo_3')) {
    //             $provider->work_photo_3 = $request->file('work_photo_3')->store('contractor/work_photos', 'public');
    //         }

    //         $provider->status = 'pending';
    //         $provider->save();

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Contractor form submitted successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again.');
    //     }
    // }
    public function store(Request $request)
{
    // SIMPLE VALIDATION
    $request->validate([
        'project_types' => 'required|array',
        'company_name' => 'required',
        'msme_registered' => 'required'
    ]);

    // FIX "on" VALUE FROM RADIO
    $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    // SAVE DATA
    ContractorProvider::create([
        'project_types' => $request->project_types, // cast handles array
        'experience_years' => $request->experience_years,
        'team_size' => $request->team_size,
        'state' => $request->state,
        'region' => $request->region,
        'city' => $request->city,
        'minimum_project_value' => $request->minimum_project_value,

        'company_name' => $request->company_name,
        'entity_type' => $request->entity_type,
        'registered_address' => $request->registered_address,
        'contact_person_designation' => $request->contact_person_designation,
        'contact_person_name' => $request->contact_person_name,

        'pan_number' => $request->pan_number,
        'tan_number' => $request->tan_number,
        'esic_number' => $request->esic_number,
        'pf_number' => $request->pf_number,

        'msme_registered' => $msme,

        'status' => 'pending',
    ]);

    return back()->with('success', 'Data saved successfully');
}
}