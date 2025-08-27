<h2>Your Pets</h2>
<div class="row mb-4">
  @foreach(Auth::user()->owner->pets as $pet)
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5>{{ $pet->name }} <small>({{ $pet->species }})</small></h5>
          <a href="{{ route('appointments.create', ['pet_id' => $pet->id]) }}"
             class="btn btn-sm btn-primary">
            Book Appointment
          </a>
        </div>
      </div>
    </div>
  @endforeach
</div>

<h2>Upcoming Appointments</h2>
<ul class="list-group">
  @forelse(Auth::user()->owner->appointments()->upcoming()->get() as $appt)
    <li class="list-group-item">
      {{ $appt->start_time->format('M d, H:i') }} — Dr. {{ $appt->veterinarian->fullName }}
      <a href="{{ route('appointments.show', $appt) }}" class="btn btn-sm btn-info float-end">
        View
      </a>
    </li>
  @empty
    <li class="list-group-item text-center">No upcoming appointments.</li>
  @endforelse
</ul>