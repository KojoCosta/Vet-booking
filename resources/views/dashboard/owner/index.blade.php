@extends('dashboard.owner.layout')

@section('title', 'Owner Dashboard')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

  <div class="card mb-4">
    <div class="card-header bg-info text-white">Upcoming Appointments</div>
    <div class="card-body">
      @if($appointments->count())
        <ul class="list-group">
          @foreach($appointments as $appt)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ $appt->pet->name }} with Dr. {{ $appt->veterinarian->user->name ?? '—' }}
              <span class="badge bg-primary">{{ \Carbon\Carbon::parse($appt->scheduled_at)->format('M d, H:i') }}</span>
            </li>
          @endforeach
        </ul>
      @else
        <p>No upcoming appointments.</p>
      @endif
    </div>
  </div>
</div>
<div id="owner-pets-root"></div>

@push('scripts')
  {{--<script src="{{ mix('js/app.js') }}"></script>--}}
  <script src="{{ asset('resources/js/app.js') }}"></script>
@endpush
@endsection