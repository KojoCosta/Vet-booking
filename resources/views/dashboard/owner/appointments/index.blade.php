@extends('dashboard.owner.layout')

@section('content')
<h4 class="mb-4">My Appointments</h4>

<form method="GET" class="mb-4">
    <div class="row g-2">
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="pet_id" class="form-select">
                <option value="">All Pets</option>
                @foreach($pets as $id => $name)
                    <option value="{{ $id }}" {{ request('pet_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
        </div>

        <div class="col-md-2">
            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('owner.appointments.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </div>
</form>

<table class="table table-bordered table-hover">
  <thead class="table-light">
    <tr>
      <th>Pet</th>
      <th>Veterinarian</th>
      <th>Date & Time</th>
      <th>Status</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse($appointments as $appt)
      <tr>
        <td>{{ $appt->pet->name ?? '—' }}</td>
        <td>{{ $appt->veterinarian->user->name ?? '—' }}</td>
        <td>{{ $appt->scheduled_at ? \Carbon\Carbon::parse($appt->scheduled_at)->format('M d, Y H:i') : '—' }}</td>
        <td>
          <span class="badge bg-{{ match($appt->status) {
            'upcoming' => 'info',
            'completed' => 'success',
            'canceled' => 'secondary',
            default => 'dark'
          } }}">
            {{ ucfirst($appt->status) }}
          </span>
        </td>
        <td class="text-center">
          @if($appt->status === 'upcoming')
            <form method="POST" action="{{ route('owner.appointments.cancel', $appt) }}"
                  class="d-inline" onsubmit="return confirm('Cancel this appointment?')">
              @csrf
              @method('PATCH')
              <button type="submit" class="btn btn-sm btn-outline-danger" aria-label="Cancel Appointment">
                <i class="bx bx-x-circle"></i> Cancel
              </button>
            </form>
          @endif
        </td>
      </tr>
    @empty
      <tr><td colspan="5" class="text-muted text-center">No appointments found.</td></tr>
    @endforelse
  </tbody>
</table>

<div class="mt-3">
  {{ $appointments->links() }}
</div>
@endsection