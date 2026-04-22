@extends('layouts.admin')

@section('title', 'Create New Project')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
:root{
    --navy:#1c2c3e;
    --orange:#f25c05;
    --orange-dark:#d94f04;
    --bg:#f4f7fb;
    --card:#ffffff;
    --muted:#6b7280;
    --border:#e4e9f2;
    --input:#fbfcff;
}

body{
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
}

.project-page{
    padding: 28px 0 90px;
}

.project-wrapper{
    max-width: 1540px;
    margin: 0 auto;
    padding: 0 18px;
}

.project-shell{
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 24px 60px rgba(15,23,42,0.08);
}

.project-header{
    padding: 34px 38px 24px;
    border-bottom: 1px solid #eef2f7;
    background:
        radial-gradient(circle at top right, rgba(242,92,5,0.07), transparent 24%),
        linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
}

.project-title{
    margin: 0 0 8px;
    font-size: 42px;
    line-height: 1.08;
    font-weight: 900;
    color: var(--navy);
    letter-spacing: -0.6px;
}

.project-subtitle{
    margin: 0;
    font-size: 15px;
    color: var(--muted);
}

.project-body{
    padding: 30px 38px 38px;
}

.form-section{
    background: #fff;
    border: 1px solid #edf2f8;
    border-radius: 22px;
    padding: 24px;
    box-shadow: 0 10px 24px rgba(15,23,42,0.04);
    margin-bottom: 20px;
}

.section-title{
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0 0 22px;
    font-size: 22px;
    font-weight: 800;
    color: var(--navy);
}

.section-title::before{
    content: "";
    width: 5px;
    height: 24px;
    border-radius: 999px;
    background: linear-gradient(180deg, var(--orange), #ff9d4b);
}

.form-grid{
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
    align-items: start;
}

.form-field label{
    display: block;
    font-size: 15px;
    font-weight: 700;
    color: var(--navy);
    margin-bottom: 8px;
}

.form-control-custom,
.form-select-custom,
.form-textarea-custom{
    width: 100%;
    min-height: 58px;
    background: #fbfcff;
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 14px 16px;
    font-size: 15px;
    color: #1f2937;
    outline: none;
    box-sizing: border-box;
    transition: all .25s ease;
}

.form-textarea-custom{
    min-height: 150px;
    resize: vertical;
}

.form-control-custom:focus,
.form-select-custom:focus,
.form-textarea-custom:focus{
    border-color: rgba(242,92,5,0.45);
    box-shadow: 0 0 0 4px rgba(242,92,5,0.10);
    background: #fff;
}

.input-group-custom{
    display: flex;
    width: 100%;
}

.input-icon{
    min-width: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f3f6fb;
    border: 1px solid var(--border);
    border-right: none;
    color: #94a3b8;
    border-radius: 16px 0 0 16px;
    font-size: 16px;
}

.input-group-custom .form-control-custom,
.input-group-custom .form-select-custom{
    border-radius: 0 16px 16px 0;
}

.field-hint{
    font-size: 12px;
    color: #94a3b8;
    margin-top: 6px;
}

.upload-box{
    border: 2px dashed #d8e1ec;
    border-radius: 22px;
    padding: 28px 22px;
    background: linear-gradient(180deg, #fcfdff 0%, #f7fbff 100%);
    text-align: center;
    transition: .25s ease;
}

.upload-box:hover{
    border-color: rgba(242,92,5,0.50);
    background: #fff8f2;
}

.upload-icon{
    width: 62px;
    height: 62px;
    margin: 0 auto 14px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(242,92,5,0.10);
    color: var(--orange);
    font-size: 24px;
}

.upload-title{
    font-size: 17px;
    color: var(--navy);
    font-weight: 800;
    margin-bottom: 8px;
}

.upload-subtitle{
    margin-top: 10px;
    font-size: 13px;
    color: var(--muted);
}

.desc-box{
    border: 1px solid var(--border);
    border-radius: 20px;
    background: linear-gradient(180deg, #fcfdff 0%, #fafcff 100%);
    padding: 16px;
}

.tip-box{
    margin-top: 16px;
    border: 1px solid #fde4d3;
    background: linear-gradient(135deg, #fff8f3, #ffffff);
    border-radius: 18px;
    padding: 16px 18px;
}

.tip-title{
    font-size: 16px;
    font-weight: 800;
    color: var(--navy);
    margin-bottom: 6px;
}

.tip-text{
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: var(--muted);
}

.form-actions{
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    flex-wrap: wrap;
}

.secure-note{
    font-size: 14px;
    color: var(--muted);
    font-weight: 500;
}

.submit-btn{
    min-width: 230px;
    height: 58px;
    border: none;
    border-radius: 18px;
    background: linear-gradient(135deg, #ff9a3c, var(--orange));
    color: #fff;
    font-size: 18px;
    font-weight: 800;
    box-shadow: 0 18px 38px rgba(242,92,5,0.25);
    transition: .25s ease;
}

.submit-btn:hover{
    transform: translateY(-2px);
}

.modal-content{
    border-radius: 24px !important;
    border: none !important;
}

.modal-content .form-control{
    min-height: 52px;
    border-radius: 14px;
    border: 1px solid var(--border);
}

.otp-note{
    font-size: 13px;
    color: var(--muted);
    text-align: center;
    margin-top: 10px;
}

.modal:not(.show){
    display: none;
}

@media (max-width: 1200px){
    .project-title{
        font-size: 36px;
    }

    .form-grid{
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

@media (max-width: 768px){
    .project-wrapper{
        padding: 0 12px;
    }

    .project-header,
    .project-body{
        padding-left: 16px;
        padding-right: 16px;
    }

    .project-title{
        font-size: 29px;
    }

    .form-section{
        padding: 18px;
    }

    .form-grid{
        grid-template-columns: 1fr;
    }

    .form-actions{
        flex-direction: column;
        align-items: stretch;
    }

    .submit-btn{
        width: 100%;
    }
}
</style>

<div class="project-page">
    <div class="project-wrapper">
        <div class="project-shell">
            <div class="project-header">
                <h1 class="project-title">Create New Project</h1>
                <p class="project-subtitle">Submit your project details to connect with verified vendors</p>
            </div>

            <div class="project-body">

                <form action="{{ route('admin.save.adminpost') }}" method="POST" enctype="multipart/form-data" id="projectPostForm">
                    @csrf

                    <div class="form-section">
                        <h2 class="section-title">Project Information</h2>

                        <div class="form-grid">

                            <div class="form-field">
                                <label>Vendor Type</label>
                                <div class="input-group-custom">
                                    <div class="input-icon"><i class="bi bi-briefcase"></i></div>
                                  
                                  <select class="form-select-custom" id="work_type" name="work_type_id">
                                    <option value="">Select Vendor Type</option>
                                    @foreach($work_types as $worktype)
                                        <option value="{{ $worktype->id }}"
                                            {{ ((string)($selectedWorkTypeId ?? '') === (string)$worktype->id) ? 'selected' : '' }}>
                                            {{ $worktype->work_type }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="form-field">
                                <label>Project Type</label>
                                <div class="input-group-custom">
                                    <div class="input-icon"><i class="bi bi-diagram-3"></i></div>
                                    <select class="form-select-custom" id="work_subtype" name="work_subtype_id">
                                        <option value="">Select Project Type</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-field">
                                <label>Project Title</label>
                                <div class="input-group-custom">
                                    <div class="input-icon"><i class="bi bi-pencil"></i></div>
                                    <input type="text" class="form-control-custom" name="title" id="project_title" placeholder="e.g. 2BHK Residential Construction, Office Renovation">
                                </div>
                                <div class="field-hint">A sample title will appear automatically after project type selection.</div>
                            </div>

                            <div class="form-field">
                                <label>City</label>
                                <input type="text" class="form-control-custom" name="city" placeholder="Enter city">
                            </div>

                            <div class="form-field">
                                <label>Pincode</label>
                                <input type="text" class="form-control-custom" name="pincode" placeholder="Enter pincode">
                            </div>

                            <div class="form-field">
                                <label>Approx Budget (₹)</label>
                                <select class="form-select-custom" name="budget">
                                    <option value="">Select Budget</option>
                                    @foreach($budget_range as $range)
                                        <option value="{{ $range->id }}">{{ $range->budget_range }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-field">
                                <label>Contact Name</label>
                                <input type="text" class="form-control-custom" name="contact_name" placeholder="e.g. Aniket Patil">
                            </div>

                            <div class="form-field">
                                <label>Mobile</label>
                                <input type="text" class="form-control-custom" name="mobile" id="main_mobile" placeholder="e.g. 9876543210">
                            </div>

                            <div class="form-field">
                                <label>Email</label>
                                <input type="email" class="form-control-custom" name="email" placeholder="e.g. aniket@example.com">
                            </div>

                            <div class="form-field">
                                <label>Area</label>
                                <input type="text" class="form-control-custom" name="area" placeholder="e.g. Plot: 2000 sq.ft / Built-up: 1500 sq.ft">
                            </div>

                            <div class="form-field">
                                <label>Unit</label>
                                <select class="form-select-custom" name="unit">
                                    <option value="">Select Unit</option>
                                    @foreach($unit as $units)
                                        <option value="{{ $units->id }}">{{ $units->unit }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="section-title">Project Documents</h2>

                        <div class="upload-box">
                            <div class="upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <div class="upload-title">Upload Drawings / BOQ / Reference Files</div>
                            <input type="file" class="form-control-custom" name="files" multiple>
                            <div class="upload-subtitle">PDF / JPG / PNG / Excel • Secure upload</div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2 class="section-title">Project Description</h2>

                        <div class="desc-box">
                            <textarea
                                class="form-textarea-custom"
                                rows="5"
                                name="description"
                                placeholder="Example: Construction of a 2BHK residential house on a 1500 sq.ft plot in Pune. Work includes civil, plumbing, electrical & finishing. Expected start in 1 month."></textarea>
                        </div>

                        <div class="tip-box">
                            <div class="tip-title">Helpful tip</div>
                            <p class="tip-text">
                                Mention scope of work, timeline, site condition, project size, and any important execution requirements so vendors can understand your need more clearly.
                            </p>
                        </div>

                        <div class="form-actions">
                            
                            <button class="submit-btn" type="submit">Submit Project</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

     $('#work_type').on('change', function () {
        let workTypeId = $(this).val();
        let select = $('#work_subtype');

        select.html('<option value="">Loading...</option>');

        if (workTypeId) {
            $.get('/get-project-types/' + workTypeId, function (data) {
                select.html('<option value="">Select Project Type</option>');
                data.forEach(function(item){
                    select.append(`<option value="${item.id}">${item.work_subtype}</option>`);
                });
            });
        } else {
            select.html('<option value="">Select Project Type</option>');
        }
    });

    if ($('#work_type').val() !== '') {
        $('#work_type').trigger('change');
    }
 $('#projectPostForm').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            window.location.href = "{{ route('admin.allprojects') }}";
        },
        error: function(xhr) {
            console.log(xhr.responseJSON);
        }
    });
});
   


});
</script>

@endsection