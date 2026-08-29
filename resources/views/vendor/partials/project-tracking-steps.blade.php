@if($steps->count())
    <div class="step-list">
        @foreach($steps as $step)
            @php
                $status = $step->status ?: 'pending';
                $attachments = $step->extra_data['attachments'] ?? [];
                if (!empty($step->extra_data['download_file'])) {
                    $attachments[] = [
                        'path' => $step->extra_data['download_file'],
                        'name' => $step->extra_data['download_file_name'] ?? basename($step->extra_data['download_file']),
                    ];
                }
                $subPoints = collect($step->extra_data['sub_points'] ?? [])->values();
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
                    @if($subPoints->isNotEmpty())
                        <div class="mt-2">
                            @foreach($subPoints as $subIndex => $subPoint)
                                <div class="d-flex gap-2 align-items-start py-1">
                                    <strong>{{ $step->step_order }}.{{ $subIndex + 1 }}</strong>
                                    <span>{{ $subPoint['title'] ?? 'Sub point' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if($step->input_value)
                        <div class="update-box">
                            <strong>Update:</strong> {{ $step->input_value }}
                        </div>
                    @endif
                    @if(!empty($attachments))
                        <div class="update-box">
                            <strong>Attachments:</strong>
                            @foreach($attachments as $attachment)
                                @if(!empty($attachment['path']))
                                    <a href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($attachment['path']) }}" download class="d-block">
                                        {{ $attachment['name'] ?? basename($attachment['path']) }}
                                    </a>
                                @endif
                            @endforeach
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
