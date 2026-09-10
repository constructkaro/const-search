@extends('layouts.admin')

@section('content')
@php
    $decodeList = function ($value) {
        if (blank($value)) {
            return [];
        }

        if (is_array($value)) {
            return array_values(array_filter($value, fn ($item) => filled($item)));
        }

        $decoded = json_decode($value, true);

        if (is_string($decoded)) {
            $decoded = json_decode($decoded, true);
        }

        if (is_array($decoded)) {
            return array_values(array_filter($decoded, fn ($item) => filled($item)));
        }

        return array_values(array_filter(array_map('trim', explode(',', $value)), fn ($item) => filled($item)));
    };

    $value = function ($record, $field, $default = '-') {
        if (!$record || !isset($record->{$field}) || blank($record->{$field})) {
            return $default;
        }

        return $record->{$field};
    };

    $yesNo = fn ($record, $field) => !empty($record->{$field}) ? 'Yes' : 'No';

    $fileUrl = function ($path) {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    };

    $documentFields = [
        'msme_certificate' => 'MSME Certificate',
        'pan_card' => 'PAN Card',
        'gst_certificate' => 'GST Certificate',
        'aadhaar_card' => 'Aadhaar Card',
        'aadhar_card' => 'Aadhaar Card',
        'company_profile' => 'Company Profile',
        'pf_doc' => 'PF Document',
        'esic_doc' => 'ESIC Document',
        'coa_certificate' => 'COA Certificate',
        'supporting_documents' => 'Supporting Documents',
        'work_photo_1' => 'Work Photo 1',
        'work_photo_2' => 'Work Photo 2',
        'work_photo_3' => 'Work Photo 3',
        'portfolio_image_1' => 'Portfolio Image 1',
        'portfolio_image_2' => 'Portfolio Image 2',
        'portfolio_image_3' => 'Portfolio Image 3',
        'certificate_file' => 'Certificate',
        'company_profile_file' => 'Company Profile',
        'logo_file' => 'Logo',
    ];

    $providers = [
        'Contractor Provider Form' => $contractor,
        'Architect Provider Form' => $architect,
        'Interior Provider Form' => $interior,
        'Surveyor Provider Form' => $surveyor,
        'BOQ Provider Form' => $boq,
        'Structural Audit Provider Form' => $structural,
    ];

    $typeFields = [
        'project_types' => 'Project Types',
        'asset_types' => 'Asset Types',
        'structure_types' => 'Structure Types',
        'audit_types' => 'Audit Types',
        'deliverables' => 'Deliverables',
    ];
@endphp

<style>
    .vendor-form-page .card {
        border: 1px solid #d6dee8;
        border-radius: 8px;
        overflow: hidden;
    }

    .vendor-form-page .card-header {
        font-weight: 700;
    }

    .vendor-info-grid,
    .form-detail-grid {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .detail-item {
        border: 1px solid #e6edf5;
        border-radius: 8px;
        padding: 12px 14px;
        background: #fbfdff;
        min-height: 72px;
    }

    .detail-label {
        color: #607085;
        display: block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .02em;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .detail-value {
        color: #20262e;
        font-size: 15px;
        overflow-wrap: anywhere;
    }

    .chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .chip-list .badge {
        border: 1px solid #cfe0f3;
        color: #084b87;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 10px;
    }

    .documents-grid {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
    }

    .document-card {
        align-items: center;
        border: 1px solid #dfe7f0;
        border-radius: 8px;
        display: flex;
        gap: 12px;
        min-height: 86px;
        padding: 12px;
        background: #fff;
    }

    .document-thumb {
        align-items: center;
        background: #eef5fb;
        border-radius: 8px;
        color: #084b87;
        display: flex;
        flex: 0 0 58px;
        height: 58px;
        justify-content: center;
        overflow: hidden;
        width: 58px;
    }

    .document-thumb img {
        height: 100%;
        object-fit: cover;
        width: 100%;
    }

    .document-name {
        font-size: 14px;
        font-weight: 700;
        line-height: 1.25;
        margin-bottom: 4px;
    }

    .document-link {
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }
</style>

<div class="container py-4 vendor-form-page">
    <h4 class="mb-3">Vendor Service Forms</h4>

    <div class="card mb-3">
        <div class="card-body">
            <div class="vendor-info-grid">
                <div class="detail-item">
                    <span class="detail-label">Vendor Name</span>
                    <span class="detail-value">{{ $vendor->full_name ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Company</span>
                    <span class="detail-value">{{ $vendor->company_name ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Mobile</span>
                    <span class="detail-value">{{ $vendor->mobile ?? '-' }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ $vendor->email ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    @foreach($providers as $title => $provider)
        @if($provider)
            @php
                $cityIds = $decodeList($provider->city_ids ?? null);
                $areaIds = $decodeList($provider->area_ids ?? null);
                $hasDocuments = collect(array_keys($documentFields))->contains(fn ($field) => filled($provider->{$field} ?? null));
            @endphp

            <div class="card mb-3">
                <div class="card-header bg-dark text-white">{{ $title }}</div>
                <div class="card-body">
                    @foreach($typeFields as $field => $label)
                        @php $items = $decodeList($provider->{$field} ?? null); @endphp
                        @if(count($items))
                            <div class="mb-4">
                                <span class="detail-label">{{ $label }}</span>
                                <div class="chip-list">
                                    @foreach($items as $item)
                                        <span class="badge bg-light">{{ $item }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="form-detail-grid mb-4">
                        <div class="detail-item">
                            <span class="detail-label">Experience</span>
                            <span class="detail-value">{{ $value($provider, 'experience_years') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Team Size</span>
                            <span class="detail-value">{{ $value($provider, 'team_size') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Minimum Project Value</span>
                            <span class="detail-value">{{ $value($provider, 'minimum_project_value') }}</span>
                        </div>
                        @if(isset($provider->boq_turnaround_time))
                            <div class="detail-item">
                                <span class="detail-label">BOQ Turnaround Time</span>
                                <span class="detail-value">{{ $value($provider, 'boq_turnaround_time') }}</span>
                            </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-label">Company Name</span>
                            <span class="detail-value">{{ $value($provider, 'company_name') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Entity Type</span>
                            <span class="detail-value">{{ $value($provider, 'entity_type') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Registered Address</span>
                            <span class="detail-value">{{ $value($provider, 'registered_address') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Contact Person</span>
                            <span class="detail-value">{{ $value($provider, 'contact_person_name') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Designation</span>
                            <span class="detail-value">{{ $value($provider, 'contact_person_designation') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Pincode</span>
                            <span class="detail-value">{{ $value($provider, 'pincode') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">City IDs</span>
                            <span class="detail-value">{{ count($cityIds) ? implode(', ', $cityIds) : '-' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Area IDs</span>
                            <span class="detail-value">{{ count($areaIds) ? implode(', ', $areaIds) : '-' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">PAN Number</span>
                            <span class="detail-value">{{ $value($provider, 'pan_number') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">GST Number</span>
                            <span class="detail-value">{{ $value($provider, 'gst_number') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">TAN Number</span>
                            <span class="detail-value">{{ $value($provider, 'tan_number') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">MSME Registered</span>
                            <span class="detail-value">{{ $value($provider, 'msme_registered') }}</span>
                        </div>
                        @if(property_exists($provider, 'msme_udyam_registered'))
                            <div class="detail-item">
                                <span class="detail-label">MSME / Udyam Registered</span>
                                <span class="detail-value">{{ $yesNo($provider, 'msme_udyam_registered') }}</span>
                            </div>
                        @endif
                        @if(property_exists($provider, 'available_for_emergency_inspection'))
                            <div class="detail-item">
                                <span class="detail-label">Emergency Inspection</span>
                                <span class="detail-value">{{ $yesNo($provider, 'available_for_emergency_inspection') }}</span>
                            </div>
                        @endif
                        @if(property_exists($provider, 'available_for_site_visit'))
                            <div class="detail-item">
                                <span class="detail-label">Site Visit Available</span>
                                <span class="detail-value">{{ $yesNo($provider, 'available_for_site_visit') }}</span>
                            </div>
                        @endif
                        @if(property_exists($provider, 'major_cities_covered'))
                            <div class="detail-item">
                                <span class="detail-label">Major Cities Covered</span>
                                <span class="detail-value">{{ $value($provider, 'major_cities_covered') }}</span>
                            </div>
                        @endif
                        @if(property_exists($provider, 'service_description'))
                            <div class="detail-item">
                                <span class="detail-label">Service Description</span>
                                <span class="detail-value">{{ $value($provider, 'service_description') }}</span>
                            </div>
                        @endif
                    </div>

                    <h6 class="fw-bold mb-3">Uploaded Documents</h6>
                    @if($hasDocuments)
                        <div class="documents-grid mb-4">
                            @foreach($documentFields as $field => $label)
                                @php
                                    $path = $provider->{$field} ?? null;
                                    $url = $fileUrl($path);
                                    $extension = strtolower(pathinfo($path ?? '', PATHINFO_EXTENSION));
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp

                                @if($url)
                                    <div class="document-card">
                                        <div class="document-thumb">
                                            @if($isImage)
                                                <img src="{{ $url }}" alt="{{ $label }}">
                                            @else
                                                <i class="bi bi-file-earmark-text fs-3"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="document-name">{{ $label }}</div>
                                            <a class="document-link" href="{{ $url }}" target="_blank" rel="noopener">
                                                View Document
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-4">No documents uploaded for this form.</div>
                    @endif

                    <h6 class="fw-bold mb-3">Agreement</h6>
                    <div class="form-detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Agreement Terms Accepted</span>
                            <span class="detail-value">{{ $yesNo($provider, 'agreement_terms_accepted') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Privacy Policy Accepted</span>
                            <span class="detail-value">{{ $yesNo($provider, 'privacy_policy_accepted') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Newsletter Opt In</span>
                            <span class="detail-value">{{ $yesNo($provider, 'newsletter_opt_in') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Agreement Accepted At</span>
                            <span class="detail-value">
                                {{ !empty($provider->agreement_accepted_at) ? \Carbon\Carbon::parse($provider->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @if(!$contractor && !$architect && !$interior && !$surveyor && !$boq && !$structural)
        <div class="alert alert-danger">
            No Service Provider Form Registered.
        </div>
    @endif
</div>
@endsection
