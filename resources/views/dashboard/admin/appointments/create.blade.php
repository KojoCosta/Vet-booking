@extends('dashboard.admin.layout')

@section('title', 'Schedule Appointment')

@section('content')
<div class="container-fluid py-4">
  <h2 class="h4 mb-4">Schedule New Appointment</h2>

  <form method="POST" action="{{ route('admin.appointments.store') }}" class="row g-3">
    @csrf

    <div class="col-md-6">
      <label for="pet_id" class="form-label">Pet</label>
      <select name="pet_id" class="form-select @error('pet_id') is-invalid @enderror">
        <option value="">Select pet</option>
        @foreach($pets as $pet)
          <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>
            {{ $pet->name }} ({{ $pet->owner->user->name ?? '—' }})
          </option>
        @endforeach
      </select>
      @error('pet_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label for="vet_id" class="form-label">Veterinarian</label>
      <select name="vet_id" class="form-select @error('vet_id') is-invalid @enderror">
        <option value="">Select vet</option>
        @foreach($vets as $vet)
          <option value="{{ $vet->id }}" {{ old('vet_id') == $vet->id ? 'selected' : '' }}>
            {{ $vet->user->name }}
          </option>
        @endforeach
      </select>
      @error('vet_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label for="scheduled_at" class="form-label">Scheduled Date & Time</label>
      <input type="datetime-local" name="scheduled_at"
             value="{{ old('scheduled_at') }}"
             class="form-control @error('scheduled_at') is-invalid @enderror">
      @error('scheduled_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label for="status" class="form-label">Status</label>
      <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach(['pending', 'completed', 'canceled'] as $status)
          <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
            {{ ucfirst($status) }}
          </option>
        @endforeach
      </select>
      @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
      <label for="notes" class="form-label">Notes</label>
      <textarea name="notes" rows="3"
                class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
      @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">
        <i class="bx bx-calendar-plus me-1"></i> Schedule Appointment
      </button>
    </div>
  </form>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // Stop default submission

    Swal.fire({
      title: 'Confirm Appointment?',
      text: 'Do you want to schedule this appointment?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, schedule it',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit(); // Proceed if confirmed
      }
    });
  });
});
</script>
@endpush
