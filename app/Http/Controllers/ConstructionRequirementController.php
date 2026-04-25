<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConstructionRequirementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',

            'house_name' => 'nullable|string|max:255',
            'area' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:20',

            'services' => 'nullable|array',
            'services.*' => 'string|max:255',

            'project_description' => 'nullable|string',
        ]);

        DB::table('construction_requirements')->insert([
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'email' => $request->email,

            'house_name' => $request->house_name,
            'area' => $request->area,
            'city' => $request->city,
            'pincode' => $request->pincode,

            'services' => json_encode($request->services ?? []),
            'project_description' => $request->project_description,

            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Requirement submitted successfully. Our team will contact you soon.');
    }
}