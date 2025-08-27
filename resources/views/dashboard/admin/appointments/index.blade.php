@extends('dashboard.admin.layout')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid py-4">
  <h2 class="h4 mb-4">All Appointments</h2>

  {{-- Filters --}}
  <form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
      <select name="vet_id" class="form-select">
        <option value="">All Vets</option>
        @foreach($vets as $vet)
          <option value="{{ $vet->id }}" {{ request('vet_id') == $vet->id ? 'selected' : '' }}>
            {{ $vet->user->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select">
        <option value="">All Statuses</option>
        @foreach(['upcoming', 'completed', 'cancelled'] as $status)
          <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
            {{ ucfirst($status) }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <input type="date" name="date" value="{{ request('date') }}" class="form-control">
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
  </form>

  {{-- Table --}}
  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Pet</th>
        <th>Owner</th>
        <th>Veterinarian</th>
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
          <td>{{ $appt->veterinarian->user->name ?? '—' }}</td>
          <td>{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('M d, Y h:i A') }}</td>
          <td>
            <span class="badge bg-{{ $appt->status_badge_class }}">
              {{ $appt->status_label }}
            </span>

            <div id="status-control-{{ $appt->id }}"></div>
            <script>
              window.reactMounts = window.reactMounts || [];
              window.reactMounts.push({
                id: "status-control-{{ $appt->id }}",
                component: "AppointmentStatusControl",
                props: {
                  appointmentId: {{ $appt->id }},
                  currentStatus: "{{ $appt->status }}"
                }
              });
            </script>
          </td>
          <td>
            <a href="{{ route('admin.appointments.edit', $appt) }}" class="btn btn-sm btn-outline-primary">Edit</a>
            <form action="{{ route('admin.appointments.destroy', $appt) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this appointment?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="7" class="text-center text-muted">No appointments found.</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $appointments->links() }}
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  @if(session('success'))
    Swal.fire({
      toast: true,
      position: 'top-end',
      icon: 'success',
      title: "{{ session('success') }}",
      showConfirmButton: false,
      timer: 2000,
      background: '#f0fdfa',
      iconColor: '#059669'
    });
  @endif
});
</script>
@endpush