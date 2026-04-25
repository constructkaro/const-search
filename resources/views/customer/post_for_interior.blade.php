@extends('layouts.app')

@section('title', 'Interior Designer Requirement')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
:root{
    --blue:#1a6dbf;
    --blue-l:#ddeeff;
    --blue-xl:#f0f7ff;
    --blue-border:#b8d4ef;
    --orange:#e8671a;
    --bg:#e8eef7;
    --card:#fff;
    --text:#0c1c2e;
    --sub:#4a637e;
    --muted:#8aa0b8;
    --green:#14a044;
    --fh:'Outfit',sans-serif;
    --fb:'Plus Jakarta Sans',sans-serif;
    --inp-h:52px;
    --shadow-lg:0 16px 56px rgba(26,109,191,.15);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:var(--fb);background:var(--bg);color:var(--text);}
.pg{padding:48px 24px 88px;max-width:1280px;margin:0 auto;}
.hero{text-align:center;margin-bottom:40px;}
.hero-pill{display:inline-flex;align-items:center;gap:8px;background:var(--blue);color:#fff;font-family:var(--fh);font-size:11.5px;font-weight:700;letter-spacing:.10em;text-transform:uppercase;padding:7px 20px;border-radius:999px;margin-bottom:20px;}
.hero h1{font-family:var(--fh);font-size:clamp(32px,4.5vw,50px);font-weight:900;line-height:1.08;color:var(--text);margin-bottom:14px;}
.hero h1 em{font-style:normal;color:var(--blue);}
.hero p{font-size:17px;color:var(--sub);line-height:1.6;}
.steps{display:flex;align-items:center;justify-content:center;max-width:520px;margin:0 auto 44px;}
.step{display:flex;flex-direction:column;align-items:center;gap:7px;min-width:80px;}
.step-dot{width:40px;height:40px;border-radius:50%;background:#d8e8f5;border:2.5px solid #bdd0e8;display:flex;align-items:center;justify-content:center;font-family:var(--fh);font-size:15px;font-weight:800;color:#8facc6;}
.step.active .step-dot{background:var(--blue);border-color:var(--blue);color:#fff;box-shadow:0 0 0 6px rgba(26,109,191,.16);}
.step.done .step-dot{background:var(--green);border-color:var(--green);color:#fff;}
.step-lbl{font-size:11px;font-weight:700;text-transform:uppercase;color:#8facc6;}
.step.active .step-lbl{color:var(--blue);}
.step.done .step-lbl{color:var(--green);}
.step-bar{flex:1;height:3px;background:#d8e8f5;margin-bottom:20px;min-width:56px;border-radius:99px;}
.step-bar.done{background:var(--green);}
.card{background:var(--card);border-radius:24px;box-shadow:var(--shadow-lg);overflow:hidden;}
.card-stripe{height:6px;background:linear-gradient(90deg,var(--blue) 0%,#40b0ff 52%,var(--orange) 100%);}
.card-body{padding:48px 56px 60px;}
.sec{margin-bottom:44px;}
.sec-head{display:flex;align-items:center;gap:16px;padding-bottom:20px;border-bottom:2px solid var(--blue-l);margin-bottom:32px;}
.sec-icon{width:50px;height:50px;border-radius:14px;background:var(--blue-l);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.sec-icon svg{width:24px;height:24px;stroke:var(--blue);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;}
.sec-meta h3{font-family:var(--fh);font-size:21px;font-weight:800;color:var(--text);}
.sec-meta p{font-size:14px;color:var(--sub);margin-top:3px;}
.hr{height:1.5px;background:var(--blue-l);margin:40px 0;border:none;}
.g3{display:grid;grid-template-columns:repeat(3,1fr);gap:24px 30px;}
.field{display:flex;flex-direction:column;gap:9px;}
.lbl{font-size:12px;font-weight:700;color:var(--text);letter-spacing:.05em;text-transform:uppercase;}
.req{color:var(--orange);}
.inp,.sel,.txta{width:100%;height:var(--inp-h);font-family:var(--fb);font-size:15px;font-weight:500;color:var(--text);background:var(--blue-xl);border:1.5px solid var(--blue-border);border-radius:11px;padding:0 18px;outline:none;}
.inp:focus,.sel:focus,.txta:focus{border-color:var(--blue);box-shadow:0 0 0 4px rgba(26,109,191,.13);background:#fff;}
.inp[readonly]{background:#ecf2f9;color:var(--sub);}
.sel{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%231a6dbf' viewBox='0 0 24 24'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;background-size:22px;padding-right:48px;}
.txta{height:auto;min-height:140px;padding:16px 18px;resize:vertical;line-height:1.7;}
.select2-container{width:100%!important;}
.select2-container--default .select2-selection--single{height:52px!important;border:1.5px solid var(--blue-border)!important;border-radius:11px!important;background:var(--blue-xl)!important;display:flex!important;align-items:center!important;}
.select2-container--default .select2-selection--single .select2-selection__rendered{line-height:52px!important;padding-left:18px!important;color:var(--text)!important;}
.select2-container--default .select2-selection--single .select2-selection__arrow{height:52px!important;}
.select2-container--default .select2-selection--multiple{min-height:52px!important;border:1.5px solid var(--blue-border)!important;border-radius:11px!important;background:var(--blue-xl)!important;padding:6px 12px!important;}
.select2-container--default .select2-selection--multiple .select2-selection__choice{background:var(--blue)!important;color:#fff!important;border:none!important;border-radius:8px!important;padding:4px 12px!important;font-size:13px!important;}
.cat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px;}
.cat-btn{position:relative;border:2px solid var(--blue-border);background:var(--blue-xl);border-radius:16px;padding:28px 20px 24px;cursor:pointer;transition:.24s;display:flex;flex-direction:column;align-items:center;gap:12px;overflow:hidden;}
.cat-btn::before{content:'';position:absolute;inset:0;background:linear-gradient(140deg,var(--blue),#2898ec);opacity:0;transition:.24s;}
.cat-ico{width:58px;height:58px;border-radius:16px;background:var(--blue-l);display:flex;align-items:center;justify-content:center;position:relative;z-index:1;}
.cat-ico svg{width:28px;height:28px;stroke:var(--blue);fill:none;stroke-width:2;}
.cat-txt{font-family:var(--fh);font-size:17px;font-weight:800;color:var(--text);position:relative;z-index:1;}
.cat-btn.active{border-color:transparent;box-shadow:0 12px 32px rgba(26,109,191,.32);}
.cat-btn.active::before{opacity:1;}
.cat-btn.active .cat-ico{background:rgba(255,255,255,.22);}
.cat-btn.active .cat-ico svg{stroke:#fff;}
.cat-btn.active .cat-txt{color:#fff;}
.expand-box{display:none;margin-top:20px;background:var(--blue-xl);border:1.5px solid var(--blue-border);border-radius:18px;padding:32px 36px 28px;}
.expand-box.active{display:block;}
.expand-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;}
.expand-top h4{font-family:var(--fh);font-size:18px;font-weight:800;color:var(--blue);}
.x-btn{width:36px;height:36px;border:none;border-radius:50%;background:#fff;color:var(--blue);font-size:22px;font-weight:900;cursor:pointer;}
.req-box{display:none;}
.req-box.active{display:block;}
.req-inner{background:var(--blue-xl);border:1.5px solid var(--blue-border);border-radius:18px;padding:36px 40px 32px;}
.budget-row{display:flex;align-items:center;gap:14px;flex-wrap:wrap;}
.b-inp{width:200px;height:52px;background:#fff;border:1.5px solid var(--blue-border);border-radius:11px;padding:0 18px;}
.b-tag{height:52px;padding:0 22px;background:var(--blue-l);border:1.5px solid var(--blue-border);border-radius:11px;font-weight:800;color:var(--blue);display:flex;align-items:center;}
.btn-row{display:flex;justify-content:flex-end;margin-top:28px;}
.btn-next{height:54px;border:none;border-radius:13px;background:linear-gradient(135deg,var(--blue),#2898ec);color:#fff;font-family:var(--fh);font-size:16px;font-weight:800;cursor:pointer;padding:0 38px;}
.btn-submit{width:100%;height:60px;border:none;border-radius:14px;background:linear-gradient(135deg,var(--orange),#f58030);color:#fff;font-family:var(--fh);font-size:19px;font-weight:900;cursor:pointer;margin-top:36px;}
.trust{display:flex;align-items:center;justify-content:center;gap:40px;flex-wrap:wrap;margin-top:32px;}
.trust-item{font-size:14px;font-weight:600;color:var(--sub);}
.otp-overlay{position:fixed;inset:0;background:rgba(10,20,40,.55);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;z-index:9999;padding:20px;}
.otp-overlay.show{display:flex;}
.otp-modal{background:#fff;border-radius:24px;padding:40px 36px 36px;width:100%;max-width:440px;box-shadow:0 24px 80px rgba(0,0,0,.22);position:relative;}
.otp-modal-close{position:absolute;top:16px;right:18px;border:none;background:transparent;font-size:26px;font-weight:700;color:var(--muted);cursor:pointer;}
.otp-modal h4{font-family:var(--fh);font-size:22px;font-weight:900;text-align:center;color:var(--text);margin-bottom:6px;}
.otp-modal p{font-size:14px;color:var(--sub);text-align:center;line-height:1.6;margin-bottom:28px;}
.otp-field{margin-bottom:18px;}
.otp-field label{display:block;font-size:12px;font-weight:700;text-transform:uppercase;color:var(--text);margin-bottom:8px;}
.otp-field input{width:100%;height:52px;font-size:16px;background:var(--blue-xl);border:1.5px solid var(--blue-border);border-radius:11px;padding:0 18px;outline:none;}
.otp-btn{width:100%;height:52px;border:none;border-radius:12px;font-family:var(--fh);font-size:16px;font-weight:800;cursor:pointer;margin-bottom:12px;}
.otp-btn-send{background:var(--blue-xl);border:1.5px solid var(--blue-border);color:var(--blue);}
.otp-btn-verify{background:linear-gradient(135deg,var(--blue),#2898ec);color:#fff;display:none;}
.otp-btn-verify.show{display:block;}
@media(max-width:1024px){.card-body{padding:40px}.g3{grid-template-columns:1fr 1fr}.req-inner{padding:28px 30px}}
@media(max-width:768px){.card-body{padding:28px 22px}.g3,.cat-grid{grid-template-columns:1fr}.steps{display:none}.expand-box{padding:22px 20px}.req-inner{padding:22px 18px}.b-inp{width:140px}.btn-next{width:100%}}
</style>

<div class="pg">
    <div class="hero">
        <div class="hero-pill">Post Your Requirement</div>
        <h1>Interior <em>Designer</em> Requirement</h1>
        <p>Fill out the form below and our team will contact you within 24 working hours.</p>
    </div>

    <div class="steps">
        <div class="step active" id="step1"><div class="step-dot">1</div><div class="step-lbl">Details</div></div>
        <div class="step-bar" id="bar1"></div>
        <div class="step" id="step2"><div class="step-dot">2</div><div class="step-lbl">Category</div></div>
        <div class="step-bar" id="bar2"></div>
        <div class="step" id="step3"><div class="step-dot">3</div><div class="step-lbl">Requirement</div></div>
    </div>

    <div class="card">
        <div class="card-stripe"></div>
        <div class="card-body">
            <form method="POST" action="{{ route('interior.requirement.store') }}" id="interiorForm">
                @csrf

                <div class="sec">
                    <div class="sec-head">
                        <div class="sec-icon"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                        <div class="sec-meta"><h3>Customer & Location Details</h3><p>Basic information about you and the project site</p></div>
                    </div>

                    <div class="g3">
                        <div class="field"><label class="lbl">Full Name <span class="req">*</span></label><input type="text" name="full_name" class="inp" placeholder="Enter your full name"></div>
                        <div class="field"><label class="lbl">Mobile Number <span class="req">*</span></label><input type="text" name="mobile" class="inp" placeholder="+91 00000 00000"></div>
                        <div class="field"><label class="lbl">Email ID</label><input type="email" name="email" class="inp" placeholder="you@email.com"></div>
                        <div class="field"><label class="lbl">House / Building Name</label><input type="text" name="house_name" class="inp" placeholder="e.g. Crescent Pearl B"></div>

                        <div class="field">
                            <label class="lbl">City <span class="req">*</span></label>
                            <select name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="field">
                            <label class="lbl">Area <span class="req">*</span></label>
                            <select name="area_ids[]" id="area_id" multiple></select>
                        </div>

                        <div class="field"><label class="lbl">Pincode</label><input type="text" id="pincode_id" name="pincode" class="inp" readonly placeholder="Auto-filled from area"></div>

                        <div class="field">
                            <label class="lbl">Site Status</label>
                            <select name="site_status" class="sel">
                                <option value="">Select Site Status</option>
                                <option value="New Property">New Property</option>
                                <option value="Renovation">Renovation</option>
                                <option value="Under Construction">Under Construction</option>
                            </select>
                        </div>

                        <div class="field">
                            <label class="lbl">Material Option</label>
                            <select name="material_option" class="sel">
                                <option value="">Select Material Option</option>
                                <option value="With Material">With Material</option>
                                <option value="Without Material">Without Material</option>
                                <option value="Design Only">Design Only</option>
                            </select>
                        </div>
                    </div>
                </div>

                <hr class="hr">

                <div class="sec">
                    <div class="sec-head">
                        <div class="sec-icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                        <div class="sec-meta"><h3>Select Property Category</h3><p>Choose the type of property for interior work</p></div>
                    </div>

                    <div class="cat-grid">
                        <button type="button" class="cat-btn" data-category="residential"><div class="cat-ico"><svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg></div><span class="cat-txt">Residential</span></button>
                        <button type="button" class="cat-btn" data-category="commercial"><div class="cat-ico"><svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2"/></svg></div><span class="cat-txt">Commercial</span></button>
                        <button type="button" class="cat-btn" data-category="hospitality"><div class="cat-ico"><svg viewBox="0 0 24 24"><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/></svg></div><span class="cat-txt">Hospitality</span></button>
                    </div>

                    <input type="hidden" name="property_category" id="property_category">

                    <div id="categoryBox" class="expand-box">
                        <div class="expand-top">
                            <h4 id="categoryTitle">Residential</h4>
                            <button type="button" class="x-btn" id="closeBox">×</button>
                        </div>

                        <div class="g3">
                            <div class="field"><label class="lbl">Property Type</label><select name="property_type" id="propertyType" class="sel"><option value="">Select Property Type</option></select></div>
                            <div class="field"><label class="lbl">Space Selection</label><select name="space_selection" id="spaceSelection" class="sel"><option value="">Select Space</option></select></div>
                            <div class="field"><label class="lbl">Approx Area</label><input type="text" name="approx_area" class="inp" placeholder="e.g. 850 sq.ft"></div>
                        </div>

                        <div class="btn-row">
                            <button type="button" class="btn-next" id="nextBtn">Next Step →</button>
                        </div>
                    </div>
                </div>

                <div id="requirementBox" class="req-box">
                    <hr class="hr">

                    <div class="sec-head">
                        <div class="sec-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg></div>
                        <div class="sec-meta"><h3>Interior Requirement Details</h3><p>Your preferences, style, and budget for the project</p></div>
                    </div>

                    <div class="req-inner">
                        <div class="g3" style="margin-bottom:26px;">
                            <div class="field"><label class="lbl">Furniture Requirement</label><select name="furniture_requirement" class="sel"><option value="">Select Requirement</option><option>Modular Kitchen</option><option>Wardrobe</option><option>TV Unit</option><option>Bed</option><option>Sofa</option><option>Office Table</option><option>Reception Counter</option><option>Other</option></select></div>
                            <div class="field"><label class="lbl">Design Style</label><select name="design_style" class="sel"><option value="">Select Design Style</option><option>Modern</option><option>Minimal</option><option>Luxury</option><option>Traditional</option><option>Contemporary</option></select></div>
                            <div class="field"><label class="lbl">Colour Theme</label><select name="color_theme" class="sel"><option value="">Select Colour Theme</option><option>Light Theme</option><option>Dark Theme</option><option>Wooden Theme</option><option>White & Gold</option><option>Custom</option></select></div>
                        </div>

                        <div class="field" style="margin-bottom:26px;">
                            <label class="lbl">Budget Range (₹ Lacs)</label>
                            <div class="budget-row">
                                <input type="text" name="budget_from" class="b-inp" placeholder="₹ From">
                                <span class="b-sep">—</span>
                                <input type="text" name="budget_to" class="b-inp" placeholder="₹ To">
                                <div class="b-tag">Lacs</div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="lbl">Additional Requirement Details</label>
                            <textarea name="additional_details" class="txta" placeholder="Any specific details, preferences, or notes about your project..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn">Submit Requirement</button>
                </div>
            </form>
        </div>
    </div>

    <div class="trust">
        <div class="trust-item">✅ 100% Verified Designers</div>
        <div class="trust-item">⏱ Response within 24 Hours</div>
        <div class="trust-item">💰 No Hidden Charges</div>
        <div class="trust-item">📞 Free Consultation</div>
    </div>
</div>

<div class="otp-overlay" id="otpOverlay">
    <div class="otp-modal">
        <button class="otp-modal-close" id="otpClose" type="button">&times;</button>
        <h4>Login Required</h4>
        <p>Verify your mobile number to submit<br>your requirement</p>

        <div class="otp-field">
            <label>Mobile Number</label>
            <input type="text" id="otp_mobile" placeholder="+91 00000 00000">
        </div>

        <div class="otp-field" id="otpInputWrap" style="display:none;">
            <label>Enter OTP</label>
            <input type="text" id="otp_code" placeholder="6-digit OTP" maxlength="6">
        </div>

        <button type="button" class="otp-btn otp-btn-send" id="sendOtpBtn">Send OTP</button>
        <button type="button" class="otp-btn otp-btn-verify" id="verifyOtpBtn">Verify & Submit</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let otpVerified = false;

const Toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
    timerProgressBar:true
});

function showToast(icon,title){
    Toast.fire({icon,title});
}

$(document).ready(function(){

    $('#city_id').select2({
        placeholder:'Select City',
        allowClear:true,
        width:'100%'
    });

    $('#area_id').select2({
        placeholder:'Select Area(s)',
        width:'100%',
        closeOnSelect:false
    });

    $('#city_id').on('change', function(){
        const cityId = $(this).val();
        $('#area_id').empty().trigger('change');
        $('#pincode_id').val('');

        if(!cityId) return;

        $.ajax({
            url:"{{ route('get.areas', ':city_id') }}".replace(':city_id', cityId),
            type:'GET',
            success:function(res){
                $('#area_id').empty();
                $.each(res,function(i,area){
                    $('#area_id').append(`<option value="${area.id}">${area.name}</option>`);
                });
                $('#area_id').trigger('change');
            }
        });
    });

    $('#area_id').on('change', function(){
        const ids = $(this).val();

        if(!ids || !ids.length){
            $('#pincode_id').val('');
            return;
        }

        $.ajax({
            url:"{{ route('get.pincodes') }}",
            type:'GET',
            dataType:'json',
            data:{area_ids:ids},
            success:function(data){
                $('#pincode_id').val([...new Set(data)].join(', '));
            }
        });
    });

    $('#interiorForm').on('submit', function(e){
        e.preventDefault();

        const form = this;
        const submitBtn = $('#submitBtn');

        submitBtn.prop('disabled', true).text('Submitting...');

        $.ajax({
            url:$(form).attr('action'),
            type:'POST',
            data:new FormData(form),
            processData:false,
            contentType:false,

            success:function(res){
                if(res.status === 'otp_required'){
                    $('#otp_mobile').val($('input[name="mobile"]').val() || '');
                    $('#otpOverlay').addClass('show');
                    return;
                }

                if(res.status === 'success'){
                    Swal.fire({
                        icon:'success',
                        title:'Submitted!',
                        text:res.message || 'Interior requirement submitted successfully.',
                        confirmButtonColor:'#e8671a'
                    }).then(() => location.reload());
                    return;
                }

                Swal.fire({
                    icon:'error',
                    title:'Error',
                    text:res.message || 'Something went wrong.',
                    confirmButtonColor:'#e8671a'
                });
            },

            error:function(xhr){
                if(xhr.status === 422){
                    const messages = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    Swal.fire({
                        icon:'error',
                        title:'Validation Error',
                        html:messages,
                        confirmButtonColor:'#e8671a'
                    });
                }else{
                    Swal.fire({
                        icon:'error',
                        title:'Error',
                        text:'Something went wrong. Please try again.',
                        confirmButtonColor:'#e8671a'
                    });
                }
            },

            complete:function(){
                submitBtn.prop('disabled', false).text('Submit Requirement');
            }
        });
    });

    $('#otpClose').on('click', function(){
        $('#otpOverlay').removeClass('show');
    });

    $('#otpOverlay').on('click', function(e){
        if(e.target === this){
            $('#otpOverlay').removeClass('show');
        }
    });

    $('#sendOtpBtn').on('click', function(){
        const mobile = $('#otp_mobile').val().trim();

        if(!mobile){
            showToast('warning','Please enter mobile number');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Sending...');

        $.ajax({
            url:"{{ route('customer.send.otp') }}",
            type:'POST',
            data:{
                _token:"{{ csrf_token() }}",
                mobile:mobile
            },
            success:function(res){
                showToast('success', res.message || 'OTP sent successfully');
                $('#otpInputWrap').slideDown(200);
                $('#verifyOtpBtn').addClass('show');
                btn.text('Resend OTP');
            },
            error:function(xhr){
                showToast('error', xhr.responseJSON?.message || 'Unable to send OTP');
            },
            complete:function(){
                btn.prop('disabled', false);
            }
        });
    });

    $('#verifyOtpBtn').on('click', function(){
        const mobile = $('#otp_mobile').val().trim();
        const otp = $('#otp_code').val().trim();

        if(!mobile || !otp){
            showToast('warning','Please enter mobile and OTP');
            return;
        }

        const btn = $(this);
        btn.prop('disabled', true).text('Verifying...');

        $.ajax({
            url:"{{ route('customer.verify.otp') }}",
            type:'POST',
            data:{
                _token:"{{ csrf_token() }}",
                mobile:mobile,
                otp:otp
            },
            success:function(res){
                if(res.status === true){
                    otpVerified = true;
                    $('#otpOverlay').removeClass('show');

                    Swal.fire({
                        icon:'success',
                        title:'Verified!',
                        text:res.message || 'Mobile verified successfully.',
                        confirmButtonColor:'#e8671a'
                    }).then(() => {
                        $('#interiorForm').trigger('submit');
                    });

                    return;
                }

                showToast('error', res.message || 'Invalid OTP');
            },
            error:function(xhr){
                showToast('error', xhr.responseJSON?.message || 'Invalid OTP');
            },
            complete:function(){
                btn.prop('disabled', false).text('Verify & Submit');
            }
        });
    });
});

function setStep(n){
    [1,2,3].forEach(i=>{
        const el = document.getElementById('step'+i);
        if(!el) return;
        el.classList.remove('active','done');
        if(i < n) el.classList.add('done');
        if(i === n) el.classList.add('active');
    });

    [1,2].forEach(i=>{
        const bar = document.getElementById('bar'+i);
        if(bar) bar.classList.toggle('done', i < n);
    });
}

setStep(1);

const propOpts = {
    residential:{
        title:'Residential',
        propertyTypes:['1BHK','2BHK','3BHK','4BHK','Villa','Bungalow','Row House','Other'],
        spaces:['Living Room','Bedroom','Kitchen','Bathroom','Full Home Interior','Balcony','Other']
    },
    commercial:{
        title:'Commercial',
        propertyTypes:['Office','Showroom','Shop','Clinic','Salon','Hospital','Other'],
        spaces:['Reception','Cabin','Workstation Area','Meeting Room','Display Area','Full Commercial Space','Other']
    },
    hospitality:{
        title:'Hospitality',
        propertyTypes:['Hotel','Resort','Restaurant','Cafe','Guest House','Homestay','Other'],
        spaces:['Lobby','Room Interior','Dining Area','Kitchen Area','Reception Area','Full Property','Other']
    }
};

const catBtns = document.querySelectorAll('.cat-btn');
const categoryBox = document.getElementById('categoryBox');
const requirementBox = document.getElementById('requirementBox');
const propertyType = document.getElementById('propertyType');
const spaceSelection = document.getElementById('spaceSelection');
const categoryTitle = document.getElementById('categoryTitle');
const hiddenCat = document.getElementById('property_category');

catBtns.forEach(btn=>{
    btn.addEventListener('click', function(){
        const type = this.dataset.category;
        const data = propOpts[type];

        catBtns.forEach(b=>b.classList.remove('active'));
        this.classList.add('active');

        hiddenCat.value = data.title;
        categoryTitle.innerText = data.title;

        propertyType.innerHTML = '<option value="">Select Property Type</option>';
        spaceSelection.innerHTML = '<option value="">Select Space</option>';

        data.propertyTypes.forEach(i=>{
            propertyType.innerHTML += `<option value="${i}">${i}</option>`;
        });

        data.spaces.forEach(i=>{
            spaceSelection.innerHTML += `<option value="${i}">${i}</option>`;
        });

        categoryBox.classList.add('active');
        requirementBox.classList.remove('active');
        setStep(2);
    });
});

document.getElementById('closeBox').addEventListener('click', function(){
    categoryBox.classList.remove('active');
    requirementBox.classList.remove('active');
    catBtns.forEach(b=>b.classList.remove('active'));
    hiddenCat.value = '';
    setStep(1);
});

document.getElementById('nextBtn').addEventListener('click', function(){
    requirementBox.classList.add('active');
    setStep(3);
});
</script>

@endsection