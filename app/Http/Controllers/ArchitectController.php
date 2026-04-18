<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArchitectProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArchitectController extends Controller
{
    public function create()
    {
         $workType = DB::table('work_types')
            ->where('work_type', 'Contractor')
            ->first();

        $projectTypes = collect();

        if ($workType) {
            $projectTypes = DB::table('work_subtypes')
                ->where('work_type_id', $workType->id)
                ->orderBy('work_subtype', 'asc')
                ->pluck('work_subtype');
        }
        // dd('test');
        return view('vendor.categories.architect',compact('workType', 'projectTypes'));
    }

   public function store(Request $request)
{
    // dd($request);
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Login required');
    }

    $request->validate([
        'project_types' => 'required|array',
        'experience_years' => 'required',
        'team_size' => 'required',
        'city' => 'required',
        'minimum_project_value' => 'required|numeric',
        'company_name' => 'required',
        'registered_address' => 'required',
        'contact_person_designation' => 'required',
        'msme_registered' => 'required|in:Yes,No',
    ]);

    $existing = ArchitectProvider::where('vendor_id', $vendorId)->first();

    // FILE HANDLING FUNCTION
    function uploadFile($request, $field, $path, $existingFile = null) {
        if ($request->hasFile($field)) {
            return $request->file($field)->store($path, 'public');
        }
        return $existingFile;
    }

    $data = [
        'vendor_id' => $vendorId,
        'project_types' => $request->project_types,

        'experience_years' => $request->experience_years,
        'team_size' => $request->team_size,
        'city' => $request->city,
        'minimum_project_value' => $request->minimum_project_value,

        'company_name' => $request->company_name,
        'entity_type' => $request->entity_type,
        'registered_address' => $request->registered_address,

        'contact_person_name' => $request->contact_person_name,
        'contact_person_designation' => $request->contact_person_designation,

        'pan_number' => $request->pan_number,
        'tan_number' => $request->tan_number,
        'gst_number' => $request->gst_number,
        'coa_number' => $request->coa_number,
        'website' => $request->website,

        'esic_number' => $request->esic_number,
        'pf_number' => $request->pf_number,

        'msme_registered' => $request->msme_registered,

        // FILES
        'pan_card' => uploadFile($request, 'pan_card', 'architects/pan', $existing?->pan_card),
        'gst_certificate' => uploadFile($request, 'gst_certificate', 'architects/gst', $existing?->gst_certificate),
        'aadhaar_card' => uploadFile($request, 'aadhaar_card', 'architects/aadhaar', $existing?->aadhaar_card),
        'company_profile' => uploadFile($request, 'company_profile', 'architects/profile', $existing?->company_profile),
        'msme_certificate' => uploadFile($request, 'msme_certificate', 'architects/msme', $existing?->msme_certificate),

        'portfolio_image_1' => uploadFile($request, 'portfolio_image_1', 'architects/portfolio', $existing?->portfolio_image_1),
        'portfolio_image_2' => uploadFile($request, 'portfolio_image_2', 'architects/portfolio', $existing?->portfolio_image_2),
        'portfolio_image_3' => uploadFile($request, 'portfolio_image_3', 'architects/portfolio', $existing?->portfolio_image_3),

        'status' => 'pending',
    ];

    if ($existing) {
        $existing->update($data);
    } else {
        ArchitectProvider::create($data);
    }

    return back()->with('success', 'Saved successfully');
}
    // public function store(Request $request)
    // {
    //     $vendorId = session('vendor_id');

    //     if (!$vendorId) {
    //         return redirect()->route('login')->with('error', 'Please login first.');
    //     }

    //     $request->validate([
    //         'project_types' => 'required|array',
    //         'company_name' => 'required|string|max:255',
    //         'msme_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
    //     ]);

    //     // check existing record
    //     $existing = ArchitectProvider::where('vendor_id', $vendorId)->first();

    //     // handle file upload
    //     $msme_certificate = $existing->msme_certificate ?? null;

    //     if ($request->hasFile('msme_certificate')) {
    //         $msme_certificate = $request->file('msme_certificate')
    //             ->store('architects/msme_certificate', 'public');
    //     }

    //     // main data
    //     $data = [
    //         'vendor_id' => $vendorId,
    //         'project_types' => $request->project_types,
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
    //         'gst_number' => $request->gst_number,
    //         'coa_number' => $request->coa_number,
    //         'website' => $request->website,

    //         'msme_certificate' => $msme_certificate,
    //         'status' => 'pending',
    //     ];

    //     // update or insert
    //     if ($existing) {
    //         $existing->update($data);
    //         return back()->with('success', 'Updated successfully');
    //     } else {
    //         ArchitectProvider::create($data);
    //         return back()->with('success', 'Saved successfully');
    //     }
    // }
// public function store(Request $request)
// {
//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return redirect()->route('login')->with('error', 'Please login first.');
//     }

//     $request->validate([
//         'project_types' => 'required|array',
//         'company_name' => 'required|string|max:255',
//         'msme_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:20480',
//     ]);

//     // check existing
//     $existing = ArchitectProvider::where('vendor_id', $vendorId)->first();

//     // handle file
//     $msme_certificate = $existing->msme_certificate ?? null;

//     if ($request->hasFile('msme_certificate')) {
//         $msme_certificate = $request->file('msme_certificate')
//             ->store('architects/msme_certificate', 'public');
//     }

//     $data = [
//         'vendor_id' => $vendorId,
//         'project_types' => $request->project_types,
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
//         'gst_number' => $request->gst_number,
//         'coa_number' => $request->coa_number,
//         'website' => $request->website,

//         'msme_certificate' => $msme_certificate,
//         'status' => 'pending',
//     ];

//     if ($existing) {
//         $existing->update($data);
//         return back()->with('success', 'Updated successfully');
//     } else {
//         ArchitectProvider::create($data);
//         return back()->with('success', 'Saved successfully');
//     }
// }
}