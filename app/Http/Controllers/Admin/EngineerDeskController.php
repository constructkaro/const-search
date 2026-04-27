<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EngineerDesk;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class EngineerDeskController extends Controller
{
    public function create(Request $request)
    {
        // $query = DB::table('posts')->where('lead_status','serious','Exploring')->latest();
        $query = DB::table('posts')
            ->whereIn('lead_status', ['serious', 'Exploring'])
            ->latest();
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('contact_name', 'like', '%' . $search . '%')
                ->orWhere('mobile', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->paginate(10)->appends([
            'search' => $request->search
        ]);

        if ($request->ajax()) {
            return view('admin.project.partials.project_table', compact('posts'))->render();
        }

        $engineerDesk = null;
        return view('admin.engineer_desk.form', compact('engineerDesk','posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'nullable|integer',
            'owner_name' => 'nullable|string|max:255',
            'customer_requirement' => 'nullable|string',
            'drawing_boq' => 'nullable|string',
            'plot_size' => 'nullable|string|max:255',
            'site_condition' => 'nullable|string',
            'service_type' => 'nullable|string|max:255',
            'project_name' => 'nullable|string|max:255',
            'project_location' => 'nullable|string|max:255',
            'project_budget' => 'nullable|string|max:255',
            'project_requirement' => 'nullable|string|max:255',
            'project_timeline' => 'nullable|string|max:255',
            'project_priority' => 'nullable|string|max:255',
            'vendor_count' => 'nullable|string|max:255',
            'vendor_selection_basis' => 'nullable|string',
            'requirement_push' => 'nullable|string',
            'response_collection' => 'nullable|string',
            'comparison_notes' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'required_vendor_level' => 'nullable|string|max:255',
            'customer_pricing_terms' => 'nullable|string',
            'partner_working_terms' => 'nullable|string',
            'payment_structure' => 'nullable|string',
            'execution_responsibility' => 'nullable|string',
            'proposal_note' => 'nullable|string',
            'agreement_note' => 'nullable|string',
            'work_order_note' => 'nullable|string',
            'leegality_note' => 'nullable|string',
            'terms_locking_note' => 'nullable|string',
            'project_file_note' => 'nullable|string',
            'tracking_sheet_note' => 'nullable|string',
            'handover_note' => 'nullable|string',
            'final_output' => 'nullable|string',
        ]);

        EngineerDesk::create($validated);

        return redirect()->route('admin.engineer-desk.create')
            ->with('success', 'Engineer Desk entry added successfully.');
    }

    public function edit($id)
    {
        $engineerDesk = EngineerDesk::findOrFail($id);
        return view('admin.engineer_desk.form', compact('engineerDesk'));
    }

    public function update(Request $request, $id)
    {
        $engineerDesk = EngineerDesk::findOrFail($id);

        $validated = $request->validate([
            'post_id' => 'nullable|integer',
            'owner_name' => 'nullable|string|max:255',
            'customer_requirement' => 'nullable|string',
            'drawing_boq' => 'nullable|string',
            'plot_size' => 'nullable|string|max:255',
            'site_condition' => 'nullable|string',
            'service_type' => 'nullable|string|max:255',
            'project_name' => 'nullable|string|max:255',
            'project_location' => 'nullable|string|max:255',
            'project_budget' => 'nullable|string|max:255',
            'project_requirement' => 'nullable|string|max:255',
            'project_timeline' => 'nullable|string|max:255',
            'project_priority' => 'nullable|string|max:255',
            'vendor_count' => 'nullable|string|max:255',
            'vendor_selection_basis' => 'nullable|string',
            'requirement_push' => 'nullable|string',
            'response_collection' => 'nullable|string',
            'comparison_notes' => 'nullable|string',
            'recommendation' => 'nullable|string',
            'required_vendor_level' => 'nullable|string|max:255',
            'customer_pricing_terms' => 'nullable|string',
            'partner_working_terms' => 'nullable|string',
            'payment_structure' => 'nullable|string',
            'execution_responsibility' => 'nullable|string',
            'proposal_note' => 'nullable|string',
            'agreement_note' => 'nullable|string',
            'work_order_note' => 'nullable|string',
            'leegality_note' => 'nullable|string',
            'terms_locking_note' => 'nullable|string',
            'project_file_note' => 'nullable|string',
            'tracking_sheet_note' => 'nullable|string',
            'handover_note' => 'nullable|string',
            'final_output' => 'nullable|string',
        ]);

        $engineerDesk->update($validated);

        return redirect()->route('admin.engineer-desk.edit', $engineerDesk->id)
            ->with('success', 'Engineer Desk entry updated successfully.');
    }
}