@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h4 class="mb-3">Vendor Service Forms</h4>

    <div class="card mb-3">
        <div class="card-body">
            <h5>{{ $vendor->full_name ?? '-' }}</h5>
            <p>{{ $vendor->company_name ?? '-' }}</p>
            <p>{{ $vendor->mobile ?? '-' }}</p>
        </div>
    </div>

    @if($contractor)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Contractor Provider Form</div>
            <div class="card-body">
                <p><b>Project Types:</b> {{ $contractor->project_types }}</p>
                <p><b>Experience:</b> {{ $contractor->experience_years }}</p>
                <p><b>Team Size:</b> {{ $contractor->team_size }}</p>
                @if($contractor)
                    <p><b>Agreement Terms Accepted:</b> {{ $contractor->agreement_terms_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Privacy Policy Accepted:</b> {{ $contractor->privacy_policy_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Newsletter Opt In:</b> {{ $contractor->newsletter_opt_in ? 'Yes' : 'No' }}</p>

                    <p><b>Agreement Accepted At:</b>
                        {{ $contractor->agreement_accepted_at ? \Carbon\Carbon::parse($contractor->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                    </p>
                @else
                    <p><b>Agreement Terms Accepted:</b> -</p>
                    <p><b>Privacy Policy Accepted:</b> -</p>
                    <p><b>Newsletter Opt In:</b> -</p>
                    <p><b>Agreement Accepted At:</b> -</p>
                @endif
            </div>
        </div>
    @endif

    @if($architect)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Architect Provider Form</div>
            <div class="card-body">
                <p><b>Project Types:</b> {{ $architect->project_types }}</p>
                <p><b>Experience:</b> {{ $architect->experience_years }}</p>
                <p><b>Team Size:</b> {{ $architect->team_size }}</p>
               @if($architect)
                    <p><b>Agreement Terms Accepted:</b> {{ $architect->agreement_terms_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Privacy Policy Accepted:</b> {{ $architect->privacy_policy_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Newsletter Opt In:</b> {{ $architect->newsletter_opt_in ? 'Yes' : 'No' }}</p>

                    <p><b>Agreement Accepted At:</b>
                        {{ $architect->agreement_accepted_at ? \Carbon\Carbon::parse($architect->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                    </p>
                @else
                    <p><b>Agreement Terms Accepted:</b> -</p>
                    <p><b>Privacy Policy Accepted:</b> -</p>
                    <p><b>Newsletter Opt In:</b> -</p>
                    <p><b>Agreement Accepted At:</b> -</p>
                @endif
            </div>
        </div>
    @endif

    @if($interior)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Interior Provider Form</div>
            <div class="card-body">
                <p><b>Project Types:</b> {{ $interior->project_types }}</p>
                <p><b>Experience:</b> {{ $interior->experience_years }}</p>
                <p><b>Team Size:</b> {{ $interior->team_size }}</p>
                @if($interior)
                    <p><b>Agreement Terms Accepted:</b> {{ $interior->agreement_terms_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Privacy Policy Accepted:</b> {{ $interior->privacy_policy_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Newsletter Opt In:</b> {{ $interior->newsletter_opt_in ? 'Yes' : 'No' }}</p>

                    <p><b>Agreement Accepted At:</b>
                        {{ $interior->agreement_accepted_at ? \Carbon\Carbon::parse($interior->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                    </p>
                @else
                    <p><b>Agreement Terms Accepted:</b> -</p>
                    <p><b>Privacy Policy Accepted:</b> -</p>
                    <p><b>Newsletter Opt In:</b> -</p>
                    <p><b>Agreement Accepted At:</b> -</p>
                @endif
            </div>
        </div>
    @endif

    @if($surveyor)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Surveyor Provider Form</div>
            <div class="card-body">
                <p><b>Project Types:</b> {{ $surveyor->project_types }}</p>
                <p><b>Experience:</b> {{ $surveyor->experience_years }}</p>
                <p><b>Team Size:</b> {{ $surveyor->team_size }}</p>
               @if($surveyor)
                    <p><b>Agreement Terms Accepted:</b> {{ $surveyor->agreement_terms_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Privacy Policy Accepted:</b> {{ $surveyor->privacy_policy_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Newsletter Opt In:</b> {{ $surveyor->newsletter_opt_in ? 'Yes' : 'No' }}</p>

                    <p><b>Agreement Accepted At:</b>
                        {{ $surveyor->agreement_accepted_at ? \Carbon\Carbon::parse($surveyor->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                    </p>
                @else
                    <p><b>Agreement Terms Accepted:</b> -</p>
                    <p><b>Privacy Policy Accepted:</b> -</p>
                    <p><b>Newsletter Opt In:</b> -</p>
                    <p><b>Agreement Accepted At:</b> -</p>
                @endif
            </div>
        </div>
    @endif

    @if($boq)
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">BOQ Provider Form</div>
            <div class="card-body">
                <p><b>Project Types:</b> {{ $boq->project_types }}</p>
                <p><b>Turnaround Time:</b> {{ $boq->boq_turnaround_time }}</p>
              @if($boq)
                    <p><b>Agreement Terms Accepted:</b> {{ $boq->agreement_terms_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Privacy Policy Accepted:</b> {{ $boq->privacy_policy_accepted ? 'Yes' : 'No' }}</p>

                    <p><b>Newsletter Opt In:</b> {{ $boq->newsletter_opt_in ? 'Yes' : 'No' }}</p>

                    <p><b>Agreement Accepted At:</b>
                        {{ $boq->agreement_accepted_at ? \Carbon\Carbon::parse($boq->agreement_accepted_at)->format('d M Y, h:i A') : '-' }}
                    </p>
                @else
                    <p><b>Agreement Terms Accepted:</b> -</p>
                    <p><b>Privacy Policy Accepted:</b> -</p>
                    <p><b>Newsletter Opt In:</b> -</p>
                    <p><b>Agreement Accepted At:</b> -</p>
                @endif
            </div>
        </div>
    @endif

    @if(!$contractor && !$architect && !$interior && !$surveyor && !$boq)
        <div class="alert alert-danger">
            No Service Provider Form Registered.
        </div>
    @endif

</div>
@endsection