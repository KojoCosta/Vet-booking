<h2>Today’s Appointments</h2>
<ul class="list-group mb-4">
  @foreach(Auth::user()->veterinarian->appointments()->today()->get() as $appt)
    <li class="list-group-item">
      <strong>{{ $appt->start_time->format('H:i') }}</strong>
      — {{ $appt->pet->name }} ({{ $appt->owner->first_name }})
      <a href="{{ route('appointments.show', $appt) }}" class="btn btn-sm btn-link">
        Details
      </a>
    </li>
  @endforeach
</ul>

<a href="{{ route('admin.calendar.index') }}" class="btn btn-outline-primary">
  View Full Calendar
</a>