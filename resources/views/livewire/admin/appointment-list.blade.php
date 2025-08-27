<div>
    {{-- Filter Dropdown --}}
    <select wire:model="statusFilter" class="form-select mb-3 w-auto">
        <option value="all">All</option>
        <option value="{{ \App\Models\AppointmentReaction::STATUS_PENDING }}">Pending</option>
        <option value="{{ \App\Models\AppointmentReaction::STATUS_APPROVED }}">Approved</option>
        <option value="{{ \App\Models\AppointmentReaction::STATUS_DECLINED }}">Declined</option>
    </select>

    {{-- Flash Message --}}
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Livewire Loading Indicator --}}
    <div wire:loading wire:target="updateAppointmentStatus,updateReactionStatus" class="text-muted small mb-2">
        Updating...
    </div>

    {{-- Appointment Cards --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($appointments as $appointment)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $appointment->pet->name ?? 'Unknown Pet' }}</h5>
                        <p><strong>Owner:</strong> {{ $appointment->pet->owner->user->name ?? 'N/A' }}</p>
                        <p><strong>Scheduled:</strong> {{ $appointment->scheduled_at }}</p>

                        {{-- Appointment Status --}}
                        <p>
                            <strong>Appointment Status:</strong>
                            <span class="badge bg-{{ $appointment->status_badge_class }}">
                                {{ $appointment->status_label }}
                            </span>
                        </p>

                        {{-- Reaction Status --}}
                        <p>
                            <strong>Reaction:</strong>
                            <span class="badge bg-{{ $appointment->reaction->status_badge_class ?? 'secondary' }}">
                                {{ $appointment->reaction->status_label ?? 'No reaction' }}
                            </span>
                        </p>

                        {{-- Update Appointment Status --}}
                        <label class="form-label"><strong>Update Appointment:</strong></label>
                        <select wire:change="updateAppointmentStatus({{ $appointment->id }}, $event.target.value)" class="form-select mb-2">
                            <option value="">Choose</option>
                            <option value="{{ \App\Models\Appointment::STATUS_PENDING }}">Pending</option>
                            <option value="{{ \App\Models\Appointment::STATUS_CONFIRMED }}">Confirmed</option>
                            <option value="{{ \App\Models\Appointment::STATUS_CANCELED }}">Canceled</option>
                        </select>

                        {{-- Update Reaction Status --}}
                        <label class="form-label"><strong>Update Reaction:</strong></label>
                        <select wire:change="updateReactionStatus({{ $appointment->id }}, $event.target.value)" class="form-select">
                            <option value="">Choose</option>
                            <option value="{{ \App\Models\AppointmentReaction::STATUS_PENDING }}">Pending</option>
                            <option value="{{ \App\Models\AppointmentReaction::STATUS_APPROVED }}">Approve</option>
                            <option value="{{ \App\Models\AppointmentReaction::STATUS_DECLINED }}">Decline</option>
                        </select>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No appointments found for this filter.</p>
        @endforelse
    </div>
</div>