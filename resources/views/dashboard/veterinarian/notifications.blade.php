@extends('dashboard.veterinarian.layout')

@section('title', 'Notifications')

@section('content')
<div class="container-fluid py-4">
  <h2 class="h4 mb-4">My Notifications</h2>

  {{-- Notification List --}}
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Message</th>
            <th>Type</th>
            <th>Received At</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($notifications as $note)
            <tr>
              <td>{{ $note->message }}</td>
              <td>{{ ucfirst($note->type) }}</td>
              <td>{{ \Carbon\Carbon::parse($note->created_at)->format('M d, Y h:i A') }}</td>
              <td>
                <span class="badge bg-{{ $note->read_at ? 'secondary' : 'primary' }}">
                  {{ $note->read_at ? 'Read' : 'Unread' }}
                </span>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-4">
                <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                No notifications found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Pagination --}}
  <div class="mt-3">
    {{ $notifications->links() }}
  </div>
</div>
@endsection