<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StructuralAuditProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StructuralAuditController extends Controller
{

public function store(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return redirect()->route('login')->with('error', 'Login required');
    }

    $request->validate([
        'asset_types'       => 'required|array|min:1',
        'asset_types.*'     => 'string|max:255',

        'structure_types'   => 'required|array|min:1',
        'structure_types.*' => 'string|max:255',

        'audit_types'       => 'required|array|min:1',
        'audit_types.*'     => 'string|max:255',

        'deliverables'      => 'required|array|min:1',
        'deliverables.*'    => 'string|max:255',

        'team_size'             => 'nullable|string|max:100',
        'minimum_project_value' => 'nullable|numeric|min:0',

        'city_ids'   => 'required|array|min:1',
        'city_ids.*' => 'required',

        'area_ids'   => 'required|array|min:1',
        'area_ids.*' => 'required',

        'pincode' => 'required|string',

        'available_for_emergency_inspection' => 'nullable',
        'available_for_site_visit'           => 'nullable',
        'msme_udyam_registered'              => 'nullable',

        'gst_number' => 'nullable|string|max:50',
        'pan_number' => 'nullable|string|max:20',

        'service_description'  => 'nullable|string',
        'major_cities_covered' => 'nullable|string|max:500',

        'certificate_file'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:40960',
        'company_profile_file' => 'nullable|file|mimes:pdf,doc,docx|max:40960',
        'logo_file'            => 'nullable|file|mimes:jpg,jpeg,png,svg|max:40960',

        'company_name' => 'required|string|max:255',
'registered_address' => 'required|string',

'agreement_terms_accepted' => 'required|accepted',
'privacy_policy_accepted' => 'required|accepted',
'newsletter_opt_in' => 'nullable',
'agreement_accepted_at' => 'nullable|date',
    ]);

    $provider = StructuralAuditProvider::where('vendor_id', $vendorId)->first();

    if (!$provider) {
        $provider = new StructuralAuditProvider();
        $provider->vendor_id = $vendorId;
    }

    $provider->asset_types     = $request->asset_types;
    $provider->structure_types = $request->structure_types;
    $provider->audit_types     = $request->audit_types;
    $provider->deliverables    = $request->deliverables;

    $provider->city_ids = $request->city_ids;
    $provider->area_ids = $request->area_ids;
    $provider->pincode  = $request->pincode;
    $provider->company_name = $request->company_name;
$provider->registered_address = $request->registered_address;

$provider->agreement_terms_accepted = $request->agreement_terms_accepted;
$provider->privacy_policy_accepted = $request->privacy_policy_accepted;
$provider->newsletter_opt_in = $request->newsletter_opt_in ?? 0;
$provider->agreement_accepted_at = $request->agreement_accepted_at;

    $provider->team_size = $request->team_size;
    $provider->minimum_project_value = $request->minimum_project_value;

    $provider->available_for_emergency_inspection = $request->has('available_for_emergency_inspection') ? 1 : 0;
    $provider->available_for_site_visit = $request->has('available_for_site_visit') ? 1 : 0;
    $provider->msme_udyam_registered = $request->has('msme_udyam_registered') ? 1 : 0;

    $provider->gst_number = $request->gst_number;
    $provider->pan_number = $request->pan_number;

    $provider->service_description = $request->service_description;
    $provider->major_cities_covered = $request->major_cities_covered;

    if ($request->hasFile('certificate_file')) {
        $provider->certificate_file = $request->file('certificate_file')
            ->store('structural_audit/certificates', 'public');
    }

    if ($request->hasFile('company_profile_file')) {
        $provider->company_profile_file = $request->file('company_profile_file')
            ->store('structural_audit/company_profiles', 'public');
    }

    if ($request->hasFile('logo_file')) {
        $provider->logo_file = $request->file('logo_file')
            ->store('structural_audit/logos', 'public');
    }

    $provider->status = 'pending';
    $provider->save();

    return redirect()->back()
        ->with('success', 'Structural Audit Provider profile saved successfully.');
}

// public function store(Request $request)
// {
//     // dd($request);
//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return redirect()->route('login')->with('error', 'Login required');
//     }

//     $request->validate([
//         'asset_types'       => 'required|array|min:1',
//         'asset_types.*'     => 'string|max:255',

        

//         'structure_types'   => 'required|array|min:1',
//         'structure_types.*' => 'string|max:255',

//         'audit_types'       => 'required|array|min:1',
//         'audit_types.*'     => 'string|max:255',

//         'deliverables'      => 'required|array|min:1',
//         'deliverables.*'    => 'string|max:255',

//         'team_size'             => 'nullable|string|max:100',
//         'minimum_project_value' => 'nullable|numeric|min:0',

//         'city_ids'   => 'required|array|min:1',
//         'city_ids.*' => 'required',

//         'area_ids'   => 'required|array|min:1',
//         'area_ids.*' => 'required',

//         'pincode' => 'required|string',

//         'available_for_emergency_inspection' => 'nullable',
//         'available_for_site_visit'           => 'nullable',
//         'msme_udyam_registered'              => 'nullable',

//         'gst_number' => 'nullable|string|max:50',
//         'pan_number' => 'nullable|string|max:20',

//         'service_description'  => 'nullable|string',
//         'major_cities_covered' => 'nullable|string|max:500',

//         'certificate_file'     => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
//         'company_profile_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
//         'logo_file'            => 'nullable|file|mimes:jpg,jpeg,png,svg|max:5120',
//     ], [
//         'asset_types.required'     => 'Please select at least one asset / project type.',
//         'structure_types.required' => 'Please select at least one structure type.',
//         'audit_types.required'     => 'Please select at least one audit type.',
//         'deliverables.required'    => 'Please select at least one service deliverable.',
//         'city_ids.required'        => 'Please select at least one city.',
//         'area_ids.required'        => 'Please select at least one area.',
//         'pincode.required'         => 'Pincode is required.',
//         'minimum_project_value.numeric' => 'Please enter minimum project value in numbers only. Example: 500000',
//     ]);

//     $provider = StructuralAuditProvider::where('vendor_id', $vendorId)->first();

//     if (!$provider) {
//         $provider = new StructuralAuditProvider();
//         $provider->vendor_id = $vendorId;
//     }

//     $provider->asset_types     = $request->asset_types;
//     $provider->structure_types = $request->structure_types;
//     $provider->audit_types     = $request->audit_types;
//     $provider->deliverables    = $request->deliverables;

//     $provider->city_ids = json_encode($request->city_ids);
//     $provider->area_ids = json_encode($request->area_ids);
//     $provider->pincode  = $request->pincode;

//     $provider->team_size = $request->team_size;
//     $provider->minimum_project_value = $request->minimum_project_value;

//     $provider->available_for_emergency_inspection = $request->has('available_for_emergency_inspection') ? 1 : 0;
//     $provider->available_for_site_visit = $request->has('available_for_site_visit') ? 1 : 0;
//     $provider->msme_udyam_registered = $request->has('msme_udyam_registered') ? 1 : 0;

//     $provider->gst_number = $request->gst_number;
//     $provider->pan_number = $request->pan_number;

//     $provider->service_description = $request->service_description;
//     $provider->major_cities_covered = $request->major_cities_covered;

//     if ($request->hasFile('certificate_file')) {
//         $provider->certificate_file = $request->file('certificate_file')
//             ->store('structural_audit/certificates', 'public');
//     }

//     if ($request->hasFile('company_profile_file')) {
//         $provider->company_profile_file = $request->file('company_profile_file')
//             ->store('structural_audit/company_profiles', 'public');
//     }

//     if ($request->hasFile('logo_file')) {
//         $provider->logo_file = $request->file('logo_file')
//             ->store('structural_audit/logos', 'public');
//     }

//     $provider->status = 'pending';
//     $provider->save();

//     return redirect()->back()
//         ->with('success', 'Structural Audit Provider profile saved successfully.');
// }
//    public function store(Request $request)
// {
//     // dd($request);
//     $vendorId = session('vendor_id');

//     if (!$vendorId) {
//         return redirect()->route('login')->with('error', 'Login required');
//     }

//     $request->validate([
//         'asset_types'       => ['required', 'array', 'min:1'],
//         'asset_types.*'     => ['string', 'max:255'],

//         'structure_types'   => ['required', 'array', 'min:1'],
//         'structure_types.*' => ['string', 'max:255'],

//         'audit_types'       => ['required', 'array', 'min:1'],
//         'audit_types.*'     => ['string', 'max:255'],

//         'deliverables'      => ['required', 'array', 'min:1'],
//         'deliverables.*'    => ['string', 'max:255'],

//         'team_size'             => ['nullable', 'string', 'max:100'],
//         'minimum_project_value' => ['nullable', 'numeric', 'min:0'],

//         'available_for_emergency_inspection' => ['nullable'],
//         'available_for_site_visit'           => ['nullable'],
//         'msme_udyam_registered'              => ['nullable'],

//         'gst_number' => ['nullable', 'string', 'max:50'],
//         'pan_number' => ['nullable', 'string', 'max:20'],

//         'service_description'  => ['nullable', 'string'],
//         'major_cities_covered' => ['nullable', 'string', 'max:500'],

//         'certificate_file'      => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
//         'company_profile_file'  => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
//         'logo_file'             => ['nullable', 'file', 'mimes:jpg,jpeg,png,svg', 'max:5120'],
//     ], [
//         'asset_types.required'       => 'Please select at least one asset / project type.',
//         'structure_types.required'   => 'Please select at least one structure type.',
//         'audit_types.required'       => 'Please select at least one audit type.',
//         'deliverables.required'      => 'Please select at least one service deliverable.',
//         'minimum_project_value.numeric' => 'Please enter minimum project value in numbers only. Example: 500000',
//     ]);

//     DB::beginTransaction();

//     try {
//         // If vendor data exists then update, otherwise insert new
//         $provider = StructuralAuditProvider::where('vendor_id', $vendorId)->first();

//         if (!$provider) {
//             $provider = new StructuralAuditProvider();
//             $provider->vendor_id = $vendorId;
//         }

//         $provider->asset_types     = $request->asset_types;
//         $provider->structure_types = $request->structure_types;
//         $provider->audit_types     = $request->audit_types;
//         $provider->deliverables    = $request->deliverables;

//         $provider->team_size             = $request->team_size;
//         $provider->minimum_project_value = $request->minimum_project_value;

//         $provider->available_for_emergency_inspection = $request->has('available_for_emergency_inspection') ? 1 : 0;
//         $provider->available_for_site_visit           = $request->has('available_for_site_visit') ? 1 : 0;
//         $provider->msme_udyam_registered              = $request->has('msme_udyam_registered') ? 1 : 0;

//         $provider->gst_number = $request->gst_number;
//         $provider->pan_number = $request->pan_number;

//         $provider->service_description  = $request->service_description;
//         $provider->major_cities_covered = $request->major_cities_covered;

//         $provider->status = 'pending';

//         if ($request->hasFile('certificate_file')) {
//             $provider->certificate_file = $request->file('certificate_file')
//                 ->store('structural_audit/certificates', 'public');
//         }

//         if ($request->hasFile('company_profile_file')) {
//             $provider->company_profile_file = $request->file('company_profile_file')
//                 ->store('structural_audit/company_profiles', 'public');
//         }

//         if ($request->hasFile('logo_file')) {
//             $provider->logo_file = $request->file('logo_file')
//                 ->store('structural_audit/logos', 'public');
//         }

//         $provider->save();

//         DB::commit();

//         return redirect()->back()
//             ->with('success', 'Structural Audit Provider profile saved successfully.');

//     } catch (\Exception $e) {
//         DB::rollBack();

//         \Log::error('StructuralAuditController@store failed: ' . $e->getMessage());

//         return redirect()->back()
//             ->withInput()
//             ->with('error', 'Something went wrong. Please try again.');
//     }
// }
    // public function store(Request $request)
    // {
    //      $vendorId = session('vendor_id');

    //     if (!$vendorId) {
    //         return redirect()->route('login')->with('error', 'Login required');
    //     }
    //     $request->validate([
    //         // ── Arrays (all four are required, must have ≥1 item) ──
    //         'asset_types'       => ['required', 'array', 'min:1'],
    //         'asset_types.*'     => ['string', 'max:255'],

    //         'structure_types'   => ['required', 'array', 'min:1'],
    //         'structure_types.*' => ['string', 'max:255'],

    //         'audit_types'       => ['required', 'array', 'min:1'],
    //         'audit_types.*'     => ['string', 'max:255'],

    //         'deliverables'      => ['required', 'array', 'min:1'],
    //         'deliverables.*'    => ['string', 'max:255'],

    //         // ── Scalar fields ──
    //         'team_size'               => ['nullable', 'string', 'max:100'],
    //         'minimum_project_value'   => ['nullable', 'string', 'max:100'],

    //         // Checkboxes — present = 1, absent = 0; no boolean validation needed
    //         'available_for_emergency_inspection' => ['nullable'],
    //         'available_for_site_visit'           => ['nullable'],
    //         'msme_udyam_registered'              => ['nullable'],

    //         'gst_number' => ['nullable', 'string', 'max:50'],
    //         'pan_number' => ['nullable', 'string', 'max:20'],

    //         'service_description'  => ['nullable', 'string'],
    //         'major_cities_covered' => ['nullable', 'string', 'max:500'],

    //         // ── File uploads ──
    //         'certificate_file'    => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
    //         'company_profile_file'=> ['nullable', 'file', 'mimes:pdf,doc,docx',     'max:5120'],
    //         'logo_file'           => ['nullable', 'file', 'mimes:jpg,jpeg,png,svg', 'max:5120'],
    //     ], [
    //         'asset_types.required'     => 'Please select at least one asset / project type.',
    //         'structure_types.required' => 'Please select at least one structure type.',
    //         'audit_types.required'     => 'Please select at least one audit type.',
    //         'deliverables.required'    => 'Please select at least one service deliverable.',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         $provider = new StructuralAuditProvider();

    //         // ── vendor_id: set from the authenticated vendor session if available ──
    //         // Remove this line if vendor_id is not used / set elsewhere.
    //         $provider->vendor_id = $vendorId;

    //         /*
    //          * The model's $casts already declares these four as 'array'.
    //          * Eloquent will automatically JSON-encode when saving and
    //          * JSON-decode when reading — do NOT call json_encode() manually
    //          * here, otherwise the data gets double-encoded in the DB.
    //          */
    //         $provider->asset_types     = $request->asset_types;
    //         $provider->structure_types = $request->structure_types;
    //         $provider->audit_types     = $request->audit_types;
    //         $provider->deliverables    = $request->deliverables;

    //         // ── Scalar fields ──
    //         $provider->team_size             = $request->team_size;
    //         $provider->minimum_project_value = $request->minimum_project_value;

    //         // Checkbox: present in POST → 1, absent → 0
    //         $provider->available_for_emergency_inspection = $request->has('available_for_emergency_inspection') ? 1 : 0;
    //         $provider->available_for_site_visit           = $request->has('available_for_site_visit')           ? 1 : 0;
    //         $provider->msme_udyam_registered              = $request->has('msme_udyam_registered')              ? 1 : 0;

    //         $provider->gst_number = $request->gst_number;
    //         $provider->pan_number = $request->pan_number;

    //         $provider->service_description  = $request->service_description;
    //         $provider->major_cities_covered = $request->major_cities_covered;

    //         $provider->status = 'pending';

    //         // ── File uploads ──
    //         if ($request->hasFile('certificate_file')) {
    //             $provider->certificate_file = $request->file('certificate_file')
    //                 ->store('structural_audit/certificates', 'public');
    //         }

    //         if ($request->hasFile('company_profile_file')) {
    //             $provider->company_profile_file = $request->file('company_profile_file')
    //                 ->store('structural_audit/company_profiles', 'public');
    //         }

    //         if ($request->hasFile('logo_file')) {
    //             $provider->logo_file = $request->file('logo_file')
    //                 ->store('structural_audit/logos', 'public');
    //         }

    //         $provider->save();

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Structural Audit Provider profile submitted successfully.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Log for debugging; do not expose $e->getMessage() to users in production.
    //         \Log::error('StructuralAuditController@store failed: ' . $e->getMessage());

    //         return redirect()->back()
    //             ->withInput()
    //             ->with('error', 'Something went wrong. Please try again.');
    //     }
    // }
}