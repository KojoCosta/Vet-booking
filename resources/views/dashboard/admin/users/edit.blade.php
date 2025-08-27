@extends('dashboard.admin.layout')

@section('title', 'Edit Member')

@section('content')
<div class="container-fluid py-4">

  {{-- Header with Back + Delete --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Edit Member <i class="bx bx-pencil"></i></h2>
    <div>
      <a href="{{ route('admin.users.index') }}"
         class="btn btn-outline-secondary me-2">
        <i class="bx bx-arrow-back me-1"></i> Back
      </a>

      <button type="button" id="deleteBtn" class="btn btn-outline-danger">
        <i class="bx bx-trash me-1"></i> Delete Member
      </button>
    </div>
  </div>

  {{-- Update Form --}}
  <form id="updateForm" action="{{ route('admin.users.update', $user) }}" method="POST" class="row g-3">
        @csrf
        @method('PUT')

        <div class="col-md-6"> 
            <label for="name" class="form-label">Name</label> 
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="col-md-6">
            <label for="password" class="form-label">
                Password <small class="text-muted">(leave blank to keep current)</small>
            </label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="col-md-6">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

            {{-- Role --}}
        <div class="col-md-6">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select @error('role') is-invalid @enderror"  required>
                <option value="" disabled>Select role</option>
                @foreach(['admin','owner','veterinarian'] as $r)
                <option value="{{ $r }}" {{ old('role', $user->role) === $r ? 'selected' : '' }}> {{ ucfirst($r) }} </option>
                @endforeach
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Owner Fields --}}
            @if($user->role === 'owner' && $user->owner)
              <div class="col-md-6 border rounded p-3 mt-3">
                <h5>Owner Details</h5>

                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="text" name="phone"
                        value="{{ old('phone', $user->owner->phone) }}"
                        class="form-control @error('phone') is-invalid @enderror">
                  @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" name="address"
                        value="{{ old('address', $user->owner->address) }}"
                        class="form-control @error('address') is-invalid @enderror">
                  @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
            @endif

            {{-- Veterinarian Field --}}
            @if($user->role === 'veterinarian' && $user->veterinarian)
              <div class="col-md-6 border rounded p-3">
                <h5>Veterinarian Details</h5>

                <div class="mb-3">
                  <label for="vet_name" class="form-label">Clinic Display Name</label>
                  <input type="text" name="vet_name"
                        value="{{ old('vet_name', $user->veterinarian->vet_name) }}"
                        class="form-control @error('vet_name') is-invalid @enderror">
                  @error('vet_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="vet_phone" class="form-label">Phone</label>
                  <input type="text" name="vet_phone"
                        value="{{ old('phone', $user->veterinarian->phone) }}"
                        class="form-control @error('vet_phone') is-invalid @enderror">
                  @error('vet_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="license_number" class="form-label">License Number</label>
                  <input type="text" name="license_number"
                        value="{{ old('license_number', $user->veterinarian->license_number) }}"
                        class="form-control @error('license_number') is-invalid @enderror">
                  @error('license_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                  <label for="specialization" class="form-label">Specialization</label>
                  <input type="text" name="specialization"
                        value="{{ old('specialization', $user->veterinarian->specialization) }}"
                        class="form-control @error('specialization') is-invalid @enderror">
                  @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
            @endif
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">
                <i class="bx bx-save me-1"></i> Update Member
            </button>
        </div>
      </form>

  {{-- Hidden Delete Form --}}
  <form id="deleteForm" action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
  </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const deleteBtn  = document.getElementById('deleteBtn');
  const deleteForm = document.getElementById('deleteForm');

  deleteBtn.addEventListener('click', () => {
    Swal.fire({
      title: 'Delete this member?',
      text:  'This action cannot be undone.',
      icon:  'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete',
      cancelButtonText: 'Cancel'
    }).then(result => {
      if (result.isConfirmed) {
        deleteForm.submit();
      }
    });
  });


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