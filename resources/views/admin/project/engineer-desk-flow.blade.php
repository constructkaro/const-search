@extends('layouts.admin')

@section('content')
<style>
    .engineer-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .engineer-header {
        background: linear-gradient(135deg, #1c2c3e, #2f4a66);
        border-radius: 24px;
        padding: 28px;
        color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 10px 30px rgba(28, 44, 62, 0.16);
    }

    .engineer-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .engineer-header h2 {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
    }

    .engineer-header p {
        margin: 8px 0 0;
        color: #dbe5ef;
        font-size: 15px;
        max-width: 850px;
    }

    .engineer-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 30px;
        background: rgba(242, 92, 5, 0.16);
        color: #ffd2b6;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid rgba(255,255,255,0.12);
    }

    .section-card {
        background: #fff;
        border-radius: 22px;
        padding: 24px;
        border: 1px solid #ebeff5;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        margin-bottom: 24px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf1f5;
    }

    .section-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(242, 92, 5, 0.12);
        color: #f25c05;
        font-size: 20px;
        font-weight: 700;
    }

    .section-title h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1c2c3e;
    }

    .section-title p {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .form-label {
        font-weight: 600;
        color: #344054;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control,
    .form-select,
    textarea {
        border-radius: 14px !important;
        border: 1px solid #dbe3ec !important;
        padding: 12px 14px !important;
        box-shadow: none !important;
        font-size: 14px;
        min-height: 48px;
    }

    textarea.form-control {
        min-height: 110px;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #f25c05 !important;
        box-shadow: 0 0 0 0.15rem rgba(242, 92, 5, 0.15) !important;
    }

    .help-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    .top-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .info-box {
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        border: 1px solid #ebeff5;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
    }

    .info-box h6 {
        margin: 0 0 6px;
        font-size: 13px;
        color: #6b7280;
        font-weight: 600;
    }

    .info-box p {
        margin: 0;
        font-size: 20px;
        color: #1c2c3e;
        font-weight: 700;
    }

    .btn-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .btn-save {
        background: #f25c05;
        color: #fff;
        border: none;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #d94f03;
        color: #fff;
    }

    .btn-back {
        background: #1c2c3e;
        color: #fff;
        text-decoration: none;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 600;
        display: inline-block;
    }

    .btn-back:hover {
        background: #162433;
        color: #fff;
    }

    .alert {
        border-radius: 14px;
    }

    @media (max-width: 991px) {
        .top-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .engineer-page {
            padding: 14px;
        }

        .engineer-header {
            padding: 22px 18px;
        }

        .engineer-header h2 {
            font-size: 24px;
        }

        .section-card {
            padding: 18px;
        }
    }
</style>

<div class="engineer-page">
    <div class="engineer-header">
        <div class="engineer-header-top">
            <div>
                <h2>{{ isset($engineerDesk) && $engineerDesk ? 'Edit Engineer Desk' : 'Add Engineer Desk' }}</h2>
                <p>
                    Technical, commercial, documentation, vendor strategy, and project kickoff preparation form for the core engineer desk workflow.
                </p>
            </div>
            <div class="engineer-badge">Core Engine Form</div>
        </div>
    </div>

    <div class="top-info-grid">
        <div class="info-box">
            <h6>Desk Owner</h6>
            <p>{{ old('owner_name', $engineerDesk->owner_name ?? 'Manali') }}</p>
        </div>
        <div class="info-box">
            <h6>Mode</h6>
            <p>{{ isset($engineerDesk) && $engineerDesk ? 'Edit' : 'Add' }}</p>
        </div>
        <div class="info-box">
            <h6>Output</h6>
            <p>Vendor Desk</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ isset($engineerDesk) && $engineerDesk ? route('admin.engineer-desk.update', $engineerDesk->id) : route('admin.engineer-desk.store') }}" method="POST">
        @csrf

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">🧾</div>
                <div>
                    <h3>Basic Information</h3>
                    <p>Reference details for this engineer desk entry</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Post ID</label>
                    <input type="text" name="post_id" class="form-control" value="{{ old('post_id', $engineerDesk->post_id ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Owner Name</label>
                    <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name', $engineerDesk->owner_name ?? 'Manali') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Service Type</label>
                    <input type="text" name="service_type" class="form-control" placeholder="Contractor / Architect / Survey / Testing" value="{{ old('service_type', $engineerDesk->service_type ?? '') }}">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">🔧</div>
                <div>
                    <h3>A. Technical Understanding</h3>
                    <p>Capture what exactly the customer wants and technical inputs</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">What Exactly Customer Wants</label>
                    <textarea name="customer_requirement" class="form-control" rows="4">{{ old('customer_requirement', $engineerDesk->customer_requirement ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Drawing / BOQ</label>
                    <textarea name="drawing_boq" class="form-control" rows="4">{{ old('drawing_boq', $engineerDesk->drawing_boq ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Site Condition</label>
                    <textarea name="site_condition" class="form-control" rows="4">{{ old('site_condition', $engineerDesk->site_condition ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Plot Size / Area</label>
                    <input type="text" name="plot_size" class="form-control" value="{{ old('plot_size', $engineerDesk->plot_size ?? '') }}">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">📋</div>
                <div>
                    <h3>B. Lead Structuring</h3>
                    <p>Convert raw requirement into a structured internal project summary</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Name</label>
                    <input type="text" name="project_name" class="form-control" value="{{ old('project_name', $engineerDesk->project_name ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Location</label>
                    <input type="text" name="project_location" class="form-control" value="{{ old('project_location', $engineerDesk->project_location ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Budget</label>
                    <input type="text" name="project_budget" class="form-control" value="{{ old('project_budget', $engineerDesk->project_budget ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Requirement</label>
                    <input type="text" name="project_requirement" class="form-control" value="{{ old('project_requirement', $engineerDesk->project_requirement ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Timeline</label>
                    <input type="text" name="project_timeline" class="form-control" value="{{ old('project_timeline', $engineerDesk->project_timeline ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Project Priority</label>
                    <input type="text" name="project_priority" class="form-control" value="{{ old('project_priority', $engineerDesk->project_priority ?? '') }}">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">🤝</div>
                <div>
                    <h3>C. Vendor Strategy</h3>
                    <p>Pre-work before vendor desk handover</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vendor Count</label>
                    <input type="text" name="vendor_count" class="form-control" placeholder="3 / 5 / premium only" value="{{ old('vendor_count', $engineerDesk->vendor_count ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Required Vendor Level</label>
                    <input type="text" name="required_vendor_level" class="form-control" placeholder="basic / premium / specialist" value="{{ old('required_vendor_level', $engineerDesk->required_vendor_level ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Vendor Selection Basis</label>
                    <textarea name="vendor_selection_basis" class="form-control" rows="4">{{ old('vendor_selection_basis', $engineerDesk->vendor_selection_basis ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Requirement Push</label>
                    <textarea name="requirement_push" class="form-control" rows="4">{{ old('requirement_push', $engineerDesk->requirement_push ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Response Collection</label>
                    <textarea name="response_collection" class="form-control" rows="4">{{ old('response_collection', $engineerDesk->response_collection ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Comparison Notes</label>
                    <textarea name="comparison_notes" class="form-control" rows="4">{{ old('comparison_notes', $engineerDesk->comparison_notes ?? '') }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Recommendation</label>
                    <textarea name="recommendation" class="form-control" rows="4">{{ old('recommendation', $engineerDesk->recommendation ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">💰</div>
                <div>
                    <h3>D. Commercial Control</h3>
                    <p>Finalize commercial terms and responsibility mapping</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Customer-side Pricing / Margin / Service Terms</label>
                    <textarea name="customer_pricing_terms" class="form-control" rows="4">{{ old('customer_pricing_terms', $engineerDesk->customer_pricing_terms ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Partner-side Working Terms</label>
                    <textarea name="partner_working_terms" class="form-control" rows="4">{{ old('partner_working_terms', $engineerDesk->partner_working_terms ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Payment Structure</label>
                    <textarea name="payment_structure" class="form-control" rows="4">{{ old('payment_structure', $engineerDesk->payment_structure ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Execution Responsibility</label>
                    <textarea name="execution_responsibility" class="form-control" rows="4">{{ old('execution_responsibility', $engineerDesk->execution_responsibility ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">📄</div>
                <div>
                    <h3>E. Documentation</h3>
                    <p>Proposal, agreement, work order, and terms locking details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Proposal / Quotation Note</label>
                    <textarea name="proposal_note" class="form-control" rows="4">{{ old('proposal_note', $engineerDesk->proposal_note ?? '') }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Agreement Creation Note</label>
                    <textarea name="agreement_note" class="form-control" rows="4">{{ old('agreement_note', $engineerDesk->agreement_note ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Work Order Note</label>
                    <textarea name="work_order_note" class="form-control" rows="4">{{ old('work_order_note', $engineerDesk->work_order_note ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Leegality Note</label>
                    <textarea name="leegality_note" class="form-control" rows="4">{{ old('leegality_note', $engineerDesk->leegality_note ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Terms Locking Note</label>
                    <textarea name="terms_locking_note" class="form-control" rows="4">{{ old('terms_locking_note', $engineerDesk->terms_locking_note ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">🚀</div>
                <div>
                    <h3>F. Project Kickoff Prep</h3>
                    <p>Prepare handover notes and execution readiness</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Project File Note</label>
                    <textarea name="project_file_note" class="form-control" rows="4">{{ old('project_file_note', $engineerDesk->project_file_note ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tracking Sheet Note</label>
                    <textarea name="tracking_sheet_note" class="form-control" rows="4">{{ old('tracking_sheet_note', $engineerDesk->tracking_sheet_note ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Handover Note</label>
                    <textarea name="handover_note" class="form-control" rows="4">{{ old('handover_note', $engineerDesk->handover_note ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">
                <div class="section-icon">➡️</div>
                <div>
                    <h3>Final Output</h3>
                    <p>Final structured result before moving ahead</p>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Output Note</label>
                <textarea name="final_output" class="form-control" rows="4">{{ old('final_output', $engineerDesk->final_output ?? 'Send to Vendor Desk') }}</textarea>
            </div>
        </div>

        <div class="btn-row">
            <button type="submit" class="btn btn-save">
                {{ isset($engineerDesk) && $engineerDesk ? 'Update Engineer Desk' : 'Save Engineer Desk' }}
            </button>

            <a href="{{ url()->previous() }}" class="btn-back">Back</a>
        </div>
    </form>
</div>
@endsection