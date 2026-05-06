<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\ArchitectProvider;
use App\Models\ContractorProvider;
use App\Models\InteriorProvider;
use App\Models\SurveyorProvider;
use App\Models\VendorBoqProfile;

class VendorCategoryController extends Controller
{
    public function index()
    {
        $vendorId = session('vendor_id');
        // dd($vendorId);
        $categories = [
            ['name' => 'Contractor', 'slug' => 'contractor', 'icon' => 'fa-regular fa-building'],
            ['name' => 'Architect', 'slug' => 'architect', 'icon' => 'fa-regular fa-compass'],
            ['name' => 'Interior Designer', 'slug' => 'interior-designer', 'icon' => 'fa-solid fa-palette'],
            ['name' => 'Surveyor', 'slug' => 'surveyor', 'icon' => 'fa-solid fa-location-dot'],
            ['name' => 'BOQ / Estimation Expert', 'slug' => 'boq-estimation-expert', 'icon' => 'fa-solid fa-calculator'],
            // ['name' => 'Testing Lab / Agency', 'slug' => 'testing-lab-agency', 'icon' => 'fa-solid fa-flask'],
            ['name' => 'Structural Auditor / Engineer', 'slug' => 'structural-auditor-engineer', 'icon' => 'fa-solid fa-shield-halved'],
            // ['name' => 'Machinery Provider', 'slug' => 'machinery-provider', 'icon' => 'fa-solid fa-truck'],
            // ['name' => 'Facade Specialist', 'slug' => 'facade-services', 'icon' => 'fa-solid fa-border-all'],
            // ['name' => 'Welding & Fabrication', 'slug' => 'welding-fabrication', 'icon' => 'fa-solid fa-fire-flame-curved'],
            // ['name' => 'Legal / NA Support', 'slug' => 'legal-na-support', 'icon' => 'fa-solid fa-scale-balanced'],
        ];

        return view('vendor.categories.index', compact('categories'));
    }

    
    
    public function showForm($slug)
    {
        $vendorId = session('vendor_id');

        if (!$vendorId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $slugToWorkType = [
            'contractor' => 'Contractor',
            'architect' => 'Architect',
            'interior-designer' => 'Interiors',
            'surveyor' => 'Surveyor',
            'boq-estimation-expert' => 'BOQ / Estimation Expert',
            // 'testing-lab-agency' => 'Testing Lab / Agency',
            'structural-auditor-engineer' => 'Structural Auditor / Engineer',
            // 'machinery-provider' => 'Machinery Provider',
            // 'facade-services' => 'Facade Specialist',
            // 'welding-fabrication' => 'Welding & Fabrication',
            // 'legal-na-support' => 'Legal / NA Support',
        ];

        $slugToView = [
            'contractor' => 'vendor.categories.contractor',
            'architect' => 'vendor.categories.architect',
            'interior-designer' => 'vendor.categories.interior-designer',
            'surveyor' => 'vendor.categories.surveyor',
            'boq-estimation-expert' => 'vendor.categories.boq-estimation-expert',
            // 'testing-lab-agency' => 'vendor.categories.testing-lab-agency',
            'structural-auditor-engineer' => 'vendor.categories.structural-audit-professional',
            // 'machinery-provider' => 'vendor.categories.machinery-provider',
            // 'facade-services' => 'vendor.categories.facade-services',
            // 'welding-fabrication' => 'vendor.categories.welding-fabrication',
            // 'legal-na-support' => 'vendor.categories.legal-na-support',
        ];

        /* map slug to table name */
        $slugToTable = [
            'contractor' => 'contractor_providers',
            'architect' => 'architect_providers',
            'interior-designer' => 'interior_providers',
            'surveyor' => 'surveyor_providers',
            'boq-estimation-expert' => 'boq_providers',
            // 'testing-lab-agency' => 'testing_lab_agency_providers',
            'structural-auditor-engineer' => 'structural_audit_providers',
            // 'machinery-provider' => 'vendor_machinery_provider_details',
            // 'facade-services' => 'vendor_facade_services_details',
            // 'welding-fabrication' => 'vendor_welding_fabrication_details',
            // 'legal-na-support' => 'vendor_legal_na_support_details',
        ];

        if (!isset($slugToView[$slug])) {
            abort(404, 'Category form not found.');
        }

        $workTypeName = $slugToWorkType[$slug] ?? null;

        $exp_year = DB::table('experience_years')->get();
        $team_size = DB::table('team_size')->get();
        $entity_type = DB::table('entity_type')->get();

        $workType = null;
        $projectTypes = collect();

        if ($workTypeName) {
            $workType = DB::table('work_types')
                ->where('work_type', $workTypeName)
                ->first();

            if ($workType) {
                $projectTypes = DB::table('work_subtypes')
                    ->where('work_type_id', $workType->id)
                    ->orderBy('work_subtype', 'asc')
                    ->pluck('work_subtype');
            }
        }

        /* fetch logged-in vendor basic details */
        $vendor = DB::table('vendor_register')
            ->where('id', $vendorId)
            ->first();

        /* fetch existing form data if already saved */
        $existingData = null;

        if (isset($slugToTable[$slug])) {
            $existingData = DB::table($slugToTable[$slug])
                ->where('vendor_id', $vendorId)
                ->first();
        }


        $cities = DB::table('city')->orderBy('name', 'asc')->get();
        // dd($cities);
        // dd($existingData);
        return view($slugToView[$slug], [
            'workType' => $workType,
            'projectTypes' => $projectTypes,
            'experienceYears' => $exp_year,
            'team_size' => $team_size,
            'entity_type' => $entity_type,
            'vendor' => $vendor,
            'existingData' => $existingData,
            'cities' => $cities
        ]);
    }
    public function saveForm(Request $request, $slug)
    {
        return redirect()->back()->with('success', ucfirst(str_replace('-', ' ', $slug)) . ' form submitted successfully.');
    }

public function getAreas($city_id)
{
    $areas = DB::table('area')
        ->where('city_id', $city_id)
        ->orderBy('name', 'asc')
        ->select('id', 'name')
        ->get();

    return response()->json($areas);
}

public function getPincodes(Request $request)
{
    $areaIds = $request->input('area_ids', []);

    // make sure always array
    if (!is_array($areaIds)) {
        $areaIds = [$areaIds];
    }

    // remove empty values
    $areaIds = array_filter($areaIds);

    if (empty($areaIds)) {
        return response()->json([]);
    }

    $pincodes = DB::table('pincodes')
        ->whereIn('area_id', $areaIds)
        ->orderBy('pincode', 'asc')
        ->pluck('pincode')
        ->unique()
        ->values();

    return response()->json($pincodes);
}

public function acceptArchitectAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $architect = ArchitectProvider::where('vendor_id', $vendorId)->first();

    if (!$architect) {
        return response()->json([
            'status' => false,
            'message' => 'Please submit architect profile first, then accept agreement.'
        ], 422);
    }

    $architect->agreement_terms_accepted = 1;
    $architect->privacy_policy_accepted = 1;
    $architect->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($architect->agreement_accepted_at)) {
        $architect->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $architect->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $architect->agreement_accepted_at
    ]);
}

public function acceptContractorAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $contractor = ContractorProvider::where('vendor_id', $vendorId)->first();

    if (!$contractor) {
        return response()->json([
            'status' => false,
            'message' => 'Please submit contractor profile first, then accept agreement.'
        ], 422);
    }

    $contractor->agreement_terms_accepted = 1;
    $contractor->privacy_policy_accepted = 1;
    $contractor->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($contractor->agreement_accepted_at)) {
        $contractor->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $contractor->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $contractor->agreement_accepted_at
    ]);
}


public function acceptInteriorAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $interior = InteriorProvider::where('vendor_id', $vendorId)->first();

    if (!$interior) {
        return response()->json([
            'status' => false,
            'message' => 'Profile not found yet.'
        ], 200);
    }

    $interior->agreement_terms_accepted = 1;
    $interior->privacy_policy_accepted = 1;
    $interior->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($interior->agreement_accepted_at)) {
        $interior->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $interior->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $interior->agreement_accepted_at
    ]);
}

public function acceptSurveyorAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $surveyor = SurveyorProvider::where('vendor_id', $vendorId)->first();

    if (!$surveyor) {
        return response()->json([
            'status' => false,
            'message' => 'Profile not found yet.'
        ], 200);
    }

    $surveyor->agreement_terms_accepted = 1;
    $surveyor->privacy_policy_accepted = 1;
    $surveyor->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($surveyor->agreement_accepted_at)) {
        $surveyor->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $surveyor->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $surveyor->agreement_accepted_at
    ]);
}

public function acceptBoqAgreement(Request $request)
{
    $vendorId = session('vendor_id');

    if (!$vendorId) {
        return response()->json([
            'status' => false,
            'message' => 'Please login first.'
        ], 401);
    }

    $boq = VendorBoqProfile::where('vendor_id', $vendorId)->first();

    if (!$boq) {
        return response()->json([
            'status' => false,
            'message' => 'BOQ profile not found yet. Agreement will be saved when profile is submitted.'
        ], 200);
    }

    $boq->agreement_terms_accepted = 1;
    $boq->privacy_policy_accepted = 1;
    $boq->newsletter_opt_in = $request->newsletter_opt_in == 1 ? 1 : 0;

    if (empty($boq->agreement_accepted_at)) {
        $boq->agreement_accepted_at = date('Y-m-d H:i:s');
    }

    $boq->save();

    return response()->json([
        'status' => true,
        'message' => 'Agreement accepted successfully.',
        'accepted_at' => $boq->agreement_accepted_at
    ]);
}
}