<div class="container-fluid py-4">
  <h2 class="h4 mb-4">Upcoming Appointments</h2>

  {{-- Filters --}}
  <div class="row g-2 mb-3">
    <div class="col-md-3">
      <select wire:model="status" class="form-select">
        <option value="">All Statuses</option>
        @foreach(\App\Models\Appointment::STATUSES as $key => $label)
          <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <input type="date" wire:model="date" class="form-control">
    </div>
  </div>

  {{-- Loading Spinner --}}
  <div wire:loading.flex class="justify-content-center my-3">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  {{-- Table --}}
  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Pet</th>
        <th>Owner</th>
        <th>Scheduled At</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($appointments as $appt)
        <tr>
          <td>{{ $appt->pet->name }}</td>
          <td>{{ $appt->pet->owner->user->name ?? '—' }}</td>
          <td>{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('M d, Y h:i A') }}</td>
          <td>
            <span class="badge bg-{{ $appt->status_badge_class }}">
              {{ $appt->status_label }}
            </span>
          </td>
          <td>
            <a href="{{ route('veterinarian.appointments.show', $appt) }}" class="btn btn-sm btn-outline-secondary">View</a>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted">No appointments found.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $appointments->links() }}
  </div>
</div>