<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
            ['name' => 'Testing Lab / Agency', 'slug' => 'testing-lab-agency', 'icon' => 'fa-solid fa-flask'],
            // ['name' => 'Structural Auditor / Engineer', 'slug' => 'structural-auditor-engineer', 'icon' => 'fa-solid fa-shield-halved'],
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
            'testing-lab-agency' => 'Testing Lab / Agency',
            // 'structural-auditor-engineer' => 'Structural Auditor / Engineer',
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
            'testing-lab-agency' => 'vendor.categories.testing-lab-agency',
            // 'structural-auditor-engineer' => 'vendor.categories.structural-audit-professional',
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
            'testing-lab-agency' => 'testing_lab_agency_providers',
            // 'structural-auditor-engineer' => 'vendor_structural_auditor_details',
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

// public function getPincodes(Request $request)
// {
//     $areaIds = $request->get('area_ids', []);

//     if (!is_array($areaIds)) {
//         $areaIds = [$areaIds];
//     }

//     $areaIds = array_filter($areaIds);

//     if (empty($areaIds)) {
//         return response()->json([]);
//     }

//     $pincodes = DB::table('pincodes')
//         ->whereIn('area_id', $areaIds)
//         ->select('id', 'area_id', 'pincode')
//         ->orderBy('pincode', 'asc')
//         ->get();

//     return response()->json($pincodes);
// }
}