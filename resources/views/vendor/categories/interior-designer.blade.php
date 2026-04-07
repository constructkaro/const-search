@extends('vendor.layouts.vapp')

@section('title', 'Interior Designer Registration Form')
@section('page_title', 'Interior Designer Registration Form')

@section('content')

<style>
    :root{
        --ck-bg: #f4f7fb;
        --ck-white: #ffffff;
        --ck-navy: #0f173d;
        --ck-navy-2: #1e3766;
        --ck-navy-3: #355c9a;
        --ck-orange: #eb7a2f;
        --ck-orange-2: #f39a56;
        --ck-orange-soft: #fff4eb;
        --ck-text: #182b49;
        --ck-text-soft: #71829b;
        --ck-muted: #99a6b7;
        --ck-line: #e3eaf2;
        --ck-line-dark: #d6dfeb;
        --ck-red: #ef4444;
        --ck-shadow-sm: 0 8px 22px rgba(15, 23, 61, 0.05);
        --ck-shadow-md: 0 16px 38px rgba(15, 23, 61, 0.07);
        --ck-shadow-lg: 0 18px 38px rgba(235, 122, 47, 0.20);
        --ck-radius-xl: 28px;
        --ck-radius-lg: 20px;
        --ck-radius-md: 16px;
        --ck-radius-sm: 14px;
    }

    body{
        background:
            linear-gradient(rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15, 23, 61, 0.03) 1px, transparent 1px),
            linear-gradient(180deg, #f8fafc 0%, #eef3f8 100%);
        background-size: 56px 56px, 56px 56px, auto;
    }

    .vendor-page{max-width:1280px;margin:0 auto;padding:20px 0 36px;}
    .vendor-stack{display:flex;flex-direction:column;gap:24px;}
    .section-card{
        background:linear-gradient(180deg,#ffffff 0%,#fcfdff 100%);
        border:1px solid var(--ck-line);
        border-radius:var(--ck-radius-xl);
        box-shadow:var(--ck-shadow-md);
        padding:28px 26px 30px;
        position:relative;
        overflow:hidden;
    }
    .section-card::before{
        content:"";
        position:absolute;right:-80px;top:-80px;width:220px;height:220px;
        background:radial-gradient(circle, rgba(235,122,47,0.05) 0%, transparent 72%);
    }
    .section-head{display:flex;align-items:flex-start;gap:16px;margin-bottom:24px;position:relative;z-index:2;}
    .section-badge{
        width:54px;height:54px;border-radius:18px;background:linear-gradient(135deg,#fff4eb 0%,#ffe8d8 100%);
        color:var(--ck-orange);display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;
    }
    .section-title-wrap h2{margin:0;font-size:22px;line-height:1.15;color:var(--ck-navy-2);font-weight:900;}
    .section-title-wrap p{margin:6px 0 0;color:var(--ck-text-soft);font-size:15px;font-weight:500;}
    .field-block + .field-block{margin-top:24px;}
    .field-label{margin:0 0 12px;font-size:16px;color:var(--ck-navy);font-weight:800;}
    .field-label .req{color:var(--ck-red);}
    .field-sub{margin:-2px 0 14px;font-size:14px;color:var(--ck-text-soft);font-weight:500;}
    .form-grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 28px;}
    .form-input,.form-select,.form-textarea{
        width:100%;border:1.5px solid var(--ck-line-dark);border-radius:var(--ck-radius-md);
        background:#fff;color:var(--ck-text);font-size:16px;padding:0 18px;outline:none;transition:.22s;
    }
    .form-input,.form-select{height:58px;}
    .form-textarea{min-height:110px;resize:vertical;padding:16px 18px;}
    .form-input:focus,.form-select:focus,.form-textarea:focus{
        border-color:var(--ck-orange);box-shadow:0 0 0 4px rgba(235,122,47,0.08);
    }

    .check-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px 20px;}
    .check-card input,.radio-pill input,.upload-box-wrap input[type="file"]{display:none;}
    .check-card label{
        min-height:58px;border:1.5px solid var(--ck-line-dark);border-radius:var(--ck-radius-md);
        background:linear-gradient(180deg,#ffffff 0%,#fbfcfe 100%);
        display:flex;align-items:center;gap:14px;padding:0 18px;cursor:pointer;transition:.22s;
        font-size:16px;color:var(--ck-text);font-weight:600;
    }
    .check-card label::before{
        content:"";width:20px;height:20px;border-radius:6px;border:2px solid #c4d0de;background:#fff;flex-shrink:0;transition:.22s;
    }
    .check-card input:checked + label{
        border-color:#f3c6aa;background:linear-gradient(180deg,#fffaf6 0%,#fff2e9 100%);
        box-shadow:0 10px 18px rgba(235,122,47,0.07);
    }
    .check-card input:checked + label::before{
        background:linear-gradient(135deg,var(--ck-orange) 0%,var(--ck-orange-2) 100%);
        border-color:var(--ck-orange);box-shadow:inset 0 0 0 4px #fff;
    }

    .upload-grid-2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px 20px;}
    .upload-title{margin:0 0 8px;font-size:15px;color:var(--ck-navy);font-weight:800;}
    .upload-box{
        min-height:92px;border:1.5px solid var(--ck-line-dark);border-radius:var(--ck-radius-md);
        background:linear-gradient(180deg,#fff 0%,#fbfcfe 100%);
        display:flex;align-items:center;gap:16px;padding:16px;cursor:pointer;transition:.22s;
    }
    .upload-icon{
        width:48px;height:48px;border-radius:14px;background:#f6f7fb;color:var(--ck-orange);
        display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;
    }
    .upload-main{font-size:16px;color:var(--ck-navy);font-weight:800;margin-bottom:4px;}
    .upload-note{font-size:13px;color:var(--ck-text-soft);font-weight:500;}

    .photo-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px;}
    .photo-card{border:1px solid var(--ck-line);border-radius:18px;background:#fff;padding:14px;box-shadow:var(--ck-shadow-sm);}
    .photo-preview{
        width:100%;height:220px;border-radius:14px;overflow:hidden;background:#f5f7fb;border:1px solid var(--ck-line);
        display:flex;align-items:center;justify-content:center;
    }
    .photo-preview .placeholder{color:var(--ck-muted);font-weight:700;}

    .submit-bar{
        background:linear-gradient(135deg, rgba(255,255,255,.97) 0%, rgba(255,255,255,.93) 100%);
        border:1px solid var(--ck-line);border-radius:24px;box-shadow:var(--ck-shadow-md);
        padding:18px 22px;display:flex;align-items:center;justify-content:space-between;gap:18px;flex-wrap:wrap;
    }
    .submit-btn{
        min-width:320px;height:68px;border:none;border-radius:18px;
        background:linear-gradient(135deg,var(--ck-orange) 0%,var(--ck-orange-2) 100%);
        color:#fff;font-size:19px;font-weight:900;display:inline-flex;align-items:center;justify-content:center;gap:14px;
        box-shadow:var(--ck-shadow-lg);
    }
    .submit-note{max-width:480px;color:var(--ck-text-soft);font-size:14px;font-weight:500;line-height:1.5;}
    .section-divider{height:4px;width:100%;background:linear-gradient(90deg,var(--ck-orange), rgba(235,122,47,0.08));border-radius:999px;margin-bottom:24px;}

    @media (max-width: 1200px){
        .photo-grid{grid-template-columns:repeat(2,minmax(0,1fr));}
    }
    @media (max-width: 992px){
        .form-grid-2,.check-grid,.upload-grid-2,.photo-grid{grid-template-columns:1fr;}
        .submit-btn{min-width:100%;width:100%;}
    }
    @media (max-width: 768px){
        .vendor-page{padding:12px 0 22px;}
        .section-card{padding:18px 16px 22px;border-radius:20px;}
        .section-title-wrap h2{font-size:20px;}
    }
</style>
<form action="{{ route('interior.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="vendor-page">
    <div class="vendor-stack">

        <div class="section-card">
            <div class="section-head">
                <div class="section-badge"><i class="fa-solid fa-couch"></i></div>
                <div class="section-title-wrap">
                    <h2>Business & Work Details</h2>
                    <p>Select your interior design specialization and project expertise</p>
                </div>
            </div>

            <div class="field-block">
                <div class="field-label">Find Your Construction Vendor <span class="req">*</span></div>
                <div class="form-input" style="display:flex;align-items:center;font-weight:800;">Interior Designer</div>
            </div>

            <div class="field-block">
                <div class="field-label">Project Type <span class="req">*</span></div>
                <div class="field-sub">Select all interior project types you have experience in</div>

                @php
                    $interiorTypes = [
                        'Residential Interior Designer',
                        'Commercial Interior Designer',
                        'Office Interior Designer',
                        'Retail Interior Designer',
                        'Restaurant / Cafe Interior',
                        'Hospital Interior Designer',
                        'Hotel Interior Designer',
                        'Luxury Home Interior',
                        'Modular Kitchen Designer',
                        'Wardrobe / Furniture Designer',
                        'Turnkey Interior Contractor',
                        'Renovation Interior Designer',
                    ];
                @endphp

                <div class="check-grid">
                    @foreach($interiorTypes as $index => $type)
                        <div class="check-card">
                            <input type="checkbox" id="interior_type_{{ $index }}" name="project_types[]" value="{{ $type }}">
                            <label for="interior_type_{{ $index }}">{{ $type }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-divider"></div>

            <div class="section-head">
                <div class="section-badge"><i class="fa-solid fa-building"></i></div>
                <div class="section-title-wrap">
                    <h2>Basic Business Information</h2>
                    <p>Studio overview and operating details</p>
                </div>
            </div>

            <div class="form-grid-2">
                <div>
                    <div class="field-label">Years of Experience <span class="req">*</span></div>
                    <select class="form-select" name="experience_years">
                        <option>10+ Years</option>
                        <option>5-10 Years</option>
                        <option>2-5 Years</option>
                        <option>0-2 Years</option>
                    </select>
                </div>

                <div>
                    <div class="field-label">Team Size <span class="req">*</span></div>
                    <select class="form-select" name="team_size">
                        <option>6-20 people</option>
                        <option>1-5 people</option>
                        <option>21-50 people</option>
                        <option>50+ people</option>
                    </select>
                </div>

                <div>
                    <div class="field-label">State <span class="req">*</span></div>
                    <select class="form-select" name="state">
                        <option>Maharashtra</option>
                    </select>
                </div>

                <div>
                    <div class="field-label">Region <span class="req">*</span></div>
                    <select class="form-select" name="region">
                        <option>Raigad</option>
                    </select>
                </div>

                <div>
                    <div class="field-label">City <span class="req">*</span></div>
                    <select class="form-select" name="city">
                        <option>Khopoli</option>
                    </select>
                </div>

                <div>
                    <div class="field-label">Minimum Project Value Handled (₹) <span class="req">*</span></div>
                    <input type="text" class="form-input" name="minimum_project_value" placeholder="e.g. 200000">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-divider"></div>

            <div class="section-head">
                <div class="section-badge"><i class="fa-solid fa-id-card"></i></div>
                <div class="section-title-wrap">
                    <h2>Studio & Compliance Details</h2>
                    <p>Firm details, contact information and registrations</p>
                </div>
            </div>

            <div class="form-grid-2">
                <div>
                    <div class="field-label">Studio / Firm Name <span class="req">*</span></div>
                    <input type="text" class="form-input" name="company_name">
                </div>

                <div>
                    <div class="field-label">Type of Entity <span class="req">*</span></div>
                    <select class="form-select" name="entity_type">
                        <option>Proprietorship</option>
                        <option>Partnership</option>
                        <option>Pvt Ltd</option>
                        <option>LLP</option>
                        <option>Freelancer</option>
                    </select>
                </div>

                <div style="grid-column:1 / -1;">
                    <div class="field-label">Registered Office Address <span class="req">*</span></div>
                    <textarea class="form-textarea" name="registered_address"></textarea>
                </div>

                <div>
                    <div class="field-label">Principal Designer Name <span class="req">*</span></div>
                    <input type="text" class="form-input" name="contact_person_name">
                </div>

                <div>
                    <div class="field-label">Designation <span class="req">*</span></div>
                    <input type="text" class="form-input" name="contact_person_designation" value="Interior Designer">
                </div>

                <div>
                    <div class="field-label">PAN Number</div>
                    <input type="text" class="form-input" name="pan_number">
                </div>

                <div>
                    <div class="field-label">GST Number</div>
                    <input type="text" class="form-input" name="gst_number">
                </div>

                <div>
                    <div class="field-label">Design Specialization</div>
                    <input type="text" class="form-input" name="specialization" placeholder="e.g. Modern, Luxury, Minimal, Commercial">
                </div>

                <div>
                    <div class="field-label">Website / Portfolio Link</div>
                    <input type="text" class="form-input" name="website">
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-divider"></div>

            <div class="section-head">
                <div class="section-badge"><i class="fa-solid fa-file-arrow-up"></i></div>
                <div class="section-title-wrap">
                    <h2>Documents & Portfolio</h2>
                    <p>Upload company documents, brochure and portfolio images</p>
                </div>
            </div>

            <div class="upload-grid-2">
                <div>
                    <div class="upload-title">PAN Card <span class="req">*</span></div>
                    <label class="upload-box">
                        <div class="upload-icon"><i class="fa-regular fa-id-card"></i></div>
                        <div>
                            <div class="upload-main">Upload PAN Card</div>
                            <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                        </div>
                    </label>
                </div>

                <div>
                    <div class="upload-title">GST Certificate</div>
                    <label class="upload-box">
                        <div class="upload-icon"><i class="fa-regular fa-file-lines"></i></div>
                        <div>
                            <div class="upload-main">Upload GST Certificate</div>
                            <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                        </div>
                    </label>
                </div>

                <div>
                    <div class="upload-title">Company Profile / Brochure <span class="req">*</span></div>
                    <label class="upload-box">
                        <div class="upload-icon"><i class="fa-regular fa-building"></i></div>
                        <div>
                            <div class="upload-main">Upload Brochure</div>
                            <div class="upload-note">PDF, max 20MB</div>
                        </div>
                    </label>
                </div>

                <div>
                    <div class="upload-title">Client Testimonial / Work Completion Docs</div>
                    <label class="upload-box">
                        <div class="upload-icon"><i class="fa-regular fa-file-circle-check"></i></div>
                        <div>
                            <div class="upload-main">Upload Supporting Documents</div>
                            <div class="upload-note">PDF, JPG, PNG up to 20MB</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="field-block">
                <div class="field-label">Portfolio Images</div>
                <div class="photo-grid">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="photo-card">
                            <div class="photo-preview">
                                <div class="placeholder">Interior Project {{ $i }}</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="submit-bar">
            <button type="submit" class="submit-btn">
                <i class="fa-regular fa-paper-plane"></i>
                <span>Submit Interior Designer Profile</span>
            </button>
            <div class="submit-note">
                By submitting, you agree to ConstructKaro’s designer verification and project lead matching process.
            </div>
        </div>
    </div>
</div>
</form>
@endsection