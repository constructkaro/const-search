<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InteriorProvider;


class InteriorController extends Controller
{
    public function create()
    {
        return view('vendor.category.interior-registration');
    }

    // public function store(Request $request)
    // {
    //     dd($request);
    //     // SIMPLE VALIDATION
    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'company_name' => 'required',
    //         'msme_registered' => 'required'
    //     ]);

    //     // FIX "on" VALUE FROM RADIO
    //     $msme = $request->msme_registered === 'on' ? 'Yes' : $request->msme_registered;

    //     // SAVE DATA
    //     InteriorProvider::create([
    //         'project_types' => $request->project_types, // cast handles array
    //         'experience_years' => $request->experience_years,
    //         'team_size' => $request->team_size,
    //         'state' => $request->state,
    //         'region' => $request->region,
    //         'city' => $request->city,
    //         'minimum_project_value' => $request->minimum_project_value,

    //         'company_name' => $request->company_name,
    //         'entity_type' => $request->entity_type,
    //         'registered_address' => $request->registered_address,
    //         'contact_person_designation' => $request->contact_person_designation,
    //         'contact_person_name' => $request->contact_person_name,

    //         'pan_number' => $request->pan_number,
    //         'tan_number' => $request->tan_number,
    //         'esic_number' => $request->esic_number,
    //         'pf_number' => $request->pf_number,

    //         'msme_registered' => $msme,

    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Data saved successfully');
    // }
public function store(Request $request)
{
    $request->validate([
        'project_types' => 'required|array',
        'company_name' => 'required',
        'minimum_project_value' => 'required',
        'registered_address' => 'required',
        'contact_person_name' => 'required',
    ]);

    InteriorProvider::create([
        'project_types' => $request->project_types,
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

        // ✅ CORRECT FIELDS
        'pan_number' => $request->pan_number,
        'gst_number' => $request->gst_number,
        'specialization' => $request->specialization,
        'website' => $request->website,

        'status' => 'pending',
    ]);

    return back()->with('success', 'Data saved successfully');
}
// public function store(Request $request)
// {

//     $request->validate([
//         'project_types' => 'required|array',
//         'company_name' => 'required',
//         'minimum_project_value' => 'required|numeric',
//         'registered_address' => 'required',
//         'contact_person_name' => 'required',
//     ]);

//     $data = $request->all();

//     // FILE UPLOADS
//     if ($request->hasFile('pan_card')) {
//         $data['pan_card'] = $request->file('pan_card')->store('interior/pan', 'public');
//     }

//     if ($request->hasFile('gst_certificate')) {
//         $data['gst_certificate'] = $request->file('gst_certificate')->store('interior/gst', 'public');
//     }

//     if ($request->hasFile('company_profile')) {
//         $data['company_profile'] = $request->file('company_profile')->store('interior/profile', 'public');
//     }

//     if ($request->hasFile('portfolio_image_1')) {
//         $data['portfolio_image_1'] = $request->file('portfolio_image_1')->store('interior/portfolio', 'public');
//     }

//     if ($request->hasFile('portfolio_image_2')) {
//         $data['portfolio_image_2'] = $request->file('portfolio_image_2')->store('interior/portfolio', 'public');
//     }

//     if ($request->hasFile('portfolio_image_3')) {
//         $data['portfolio_image_3'] = $request->file('portfolio_image_3')->store('interior/portfolio', 'public');
//     }

//     $data['status'] = 'pending';

//     InteriorProvider::create($data);

//     return back()->with('success', 'Saved successfully');
// }
}