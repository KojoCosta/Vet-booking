@extends('dashboard.owner.layout')

@section('content')
<h4 class="mb-4">Book an Appointment</h4>

<form method="POST" action="{{ route('owner.appointments.store') }}">
  @csrf

  <div class="mb-3">
        <label for="pet_id" class="form-label">Pet</label>
        <select name="pet_id" class="form-select" required>
            <option value="">Select Pet</option>
            @foreach($pets as $id => $name)
                <option value="{{ $id }}" {{ old('pet_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="vet_id" class="form-label">Veterinarian</label>
        <select name="vet_id" class="form-select" required>
            <option value="">Select Veterinarian</option>
            @foreach($vets as $vet)
                <option value="{{ $vet->id }}" {{ old('vet_id') == $vet->id ? 'selected' : '' }}>
                    {{ $vet->user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="scheduled_at" class="form-label">Date & Time</label>
        <input type="datetime-local" name="scheduled_at" class="form-control" value="{{ old('scheduled_at') }}" required>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notes</label>
        <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
    </div>

  <button type="submit" class="btn btn-primary">Book Appointment</button>
</form>
@endsection