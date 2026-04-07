<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StructuralAuditProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StructuralAuditController extends Controller
{
    public function create()
    {
        return view('vendor.category.structural-auditor-engineer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_types' => 'required|array|min:1',
            'asset_types.*' => 'string',

            'structure_types' => 'required|array|min:1',
            'structure_types.*' => 'string',

            'audit_types' => 'required|array|min:1',
            'audit_types.*' => 'string',

            'deliverables' => 'required|array|min:1',
            'deliverables.*' => 'string',

            'team_size' => 'nullable|string|max:255',
            'minimum_project_value' => 'nullable|string|max:255',

            'available_for_emergency_inspection' => 'nullable',
            'available_for_site_visit' => 'nullable',
            'msme_udyam_registered' => 'nullable',

            'gst_number' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',

            'service_description' => 'nullable|string',
            'major_cities_covered' => 'nullable|string|max:1000',

            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'company_profile_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'logo_file' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:5120',
        ], [
            'asset_types.required' => 'Please select at least one asset type.',
            'structure_types.required' => 'Please select at least one structure type.',
            'audit_types.required' => 'Please select at least one audit type.',
            'deliverables.required' => 'Please select at least one service deliverable.',
        ]);

        DB::beginTransaction();

        try {
            $provider = new StructuralAuditProvider();

            $provider->asset_types = $request->asset_types;
            $provider->structure_types = $request->structure_types;
            $provider->audit_types = $request->audit_types;
            $provider->deliverables = $request->deliverables;

            $provider->team_size = $request->team_size;
            $provider->minimum_project_value = $request->minimum_project_value;

            $provider->available_for_emergency_inspection = $request->has('available_for_emergency_inspection') ? 1 : 0;
            $provider->available_for_site_visit = $request->has('available_for_site_visit') ? 1 : 0;
            $provider->msme_udyam_registered = $request->has('msme_udyam_registered') ? 1 : 0;

            $provider->gst_number = $request->gst_number;
            $provider->pan_number = $request->pan_number;

            $provider->service_description = $request->service_description;
            $provider->major_cities_covered = $request->major_cities_covered;

            $provider->status = 'pending';

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

            $provider->save();

            DB::commit();

            return redirect()->back()->with('success', 'Structural Audit Provider form submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}