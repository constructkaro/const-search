<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

            'planning_timeframe' => 'nullable|string|max:100',
            'project_description' => 'nullable|string',
        ]);

        $data = [
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
        ];

        if (Schema::hasColumn('construction_requirements', 'planning_timeframe')) {
            $data['planning_timeframe'] = $request->planning_timeframe;
        } elseif ($request->filled('planning_timeframe')) {
            $data['project_description'] = trim(
                ($data['project_description'] ? $data['project_description'] . "\n" : '')
                . 'Planning timeframe: ' . $request->planning_timeframe
            );
        }

        DB::table('construction_requirements')->insert($data);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => true,
                'message' => 'Your free construction plan request is submitted. Our team will contact you soon.',
            ]);
        }

        return back()->with('success', 'Requirement submitted successfully. Our team will contact you soon.');
    }
}
