@if($steps->count())
    <div class="step-list">
        @foreach($steps as $step)
            @php
                $status = $step->status ?: 'pending';
            @endphp
            <div class="step-card">
                <div>
                    <h4 class="step-title">{{ $step->step_title }}</h4>
                    @if($step->step_description)
                        <p class="step-desc">{{ $step->step_description }}</p>
                    @endif
                    <div class="step-meta">
                        Step {{ $step->step_order }} | {{ ucfirst($step->step_type ?: 'normal') }}
                    </div>
                    @if($step->input_value)
                        <div class="update-box">
                            <strong>Update:</strong> {{ $step->input_value }}
                        </div>
                    @endif
                </div>
                <div>
                    <span class="status-badge status-{{ $status }}">
                        {{ ucfirst($status) }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-box">No milestones found.</div>
@endif
