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
  {{ $appointments->appends(request()->query())->links() }}
</div>