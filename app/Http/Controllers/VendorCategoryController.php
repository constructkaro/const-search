<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorCategoryController extends Controller
{
   public function index()
{
    $categories = [
        ['name' => 'Contractor', 'slug' => 'contractor', 'icon' => 'fa-regular fa-building'],
        ['name' => 'Architect', 'slug' => 'architect', 'icon' => 'fa-regular fa-compass'],
        ['name' => 'Interior Designer', 'slug' => 'interior-designer', 'icon' => 'fa-solid fa-palette'],
        ['name' => 'Surveyor', 'slug' => 'surveyor', 'icon' => 'fa-solid fa-location-dot'],
        ['name' => 'BOQ / Estimation Expert', 'slug' => 'boq-estimation-expert', 'icon' => 'fa-solid fa-calculator'],
        ['name' => 'Testing Lab / Agency', 'slug' => 'testing-lab-agency', 'icon' => 'fa-solid fa-flask'],
        ['name' => 'Structural Auditor / Engineer', 'slug' => 'structural-auditor-engineer', 'icon' => 'fa-solid fa-shield-halved'],
        ['name' => 'Machinery Provider', 'slug' => 'machinery-provider', 'icon' => 'fa-solid fa-truck'],
        ['name' => 'Facade Specialist', 'slug' => 'facade-services', 'icon' => 'fa-solid fa-border-all'],
        ['name' => 'Welding & Fabrication', 'slug' => 'welding-fabrication', 'icon' => 'fa-solid fa-fire-flame-curved'],
        ['name' => 'Legal / NA Support', 'slug' => 'legal-na-support', 'icon' => 'fa-solid fa-scale-balanced'],
    ];

    return view('vendor.categories.index', compact('categories'));
}

public function showForm($slug)
{
    switch ($slug) {
        case 'contractor':
            return view('vendor.categories.contractor');

        case 'architect':
            return view('vendor.categories.architect');

        case 'interior-designer':
            return view('vendor.categories.interior-designer');

        case 'surveyor':
            return view('vendor.categories.surveyor');

        case 'boq-estimation-expert':
            return view('vendor.categories.boq-estimation-expert');

        case 'testing-lab-agency':
            return view('vendor.categories.testing-lab-agency');

        case 'structural-auditor-engineer':
            return view('vendor.categories.structural-audit-professional');

        case 'machinery-provider':
            return view('vendor.categories.machinery-provider');

        case 'facade-services':
            return view('vendor.categories.facade-services');

        case 'welding-fabrication':
            return view('vendor.categories.welding-fabrication');

        case 'legal-na-support':
            return view('vendor.categories.legal-na-support');

        default:
            abort(404, 'Category form not found.');
    }
}

    public function saveForm(Request $request, $slug)
    {
        // save category form data here

        return redirect()->back()->with('success', ucfirst(str_replace('-', ' ', $slug)) . ' form submitted successfully.');
    }
}