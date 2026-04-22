<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngineerDesk extends Model
{
    protected $fillable = [
        'post_id',
        'owner_name',
        'customer_requirement',
        'drawing_boq',
        'plot_size',
        'site_condition',
        'service_type',
        'project_name',
        'project_location',
        'project_budget',
        'project_requirement',
        'project_timeline',
        'project_priority',
        'vendor_count',
        'vendor_selection_basis',
        'requirement_push',
        'response_collection',
        'comparison_notes',
        'recommendation',
        'required_vendor_level',
        'customer_pricing_terms',
        'partner_working_terms',
        'payment_structure',
        'execution_responsibility',
        'proposal_note',
        'agreement_note',
        'work_order_note',
        'leegality_note',
        'terms_locking_note',
        'project_file_note',
        'tracking_sheet_note',
        'handover_note',
        'final_output',
    ];
}