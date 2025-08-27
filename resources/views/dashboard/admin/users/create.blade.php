{{-- resources/views/dashboard/admin/users/create.blade.php --}}
@extends('dashboard.admin.layout')

@section('content')
<div class="container-fluid py-4">
     {{-- Page Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">Add New User <i class="bx bx-user-plus me-1"></i></h2>
    {{-- Back Button --}}
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
      <i class="bx bx-arrow-back me-1"></i> Back to List
    </a>
  </div>

   {{-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif --}}

    <form id="userForm" method="POST" action="{{ route('admin.users.store') }}" class="row g-3" >

        @csrf

        {{-- Name --}}
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name"class="form-control @error('name') is-invalid @enderror"value="{{ old('name') }}">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Email --}}
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Password --}}
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Password Confirmation --}}
        <div class="col-md-6">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        {{-- Role selector --}}
        <div class="col-md-6">
            <label for="role" class="form-label">Role</label>
            <select id="roleSelect" name="role" class="form-select @error('role') is-invalid @enderror">
                <option value="">-- Choose Role --</option>
                <option value="admin"         {{ old('role')==='admin' ? 'selected':'' }}>Admin</option>
                <option value="owner"         {{ old('role')==='owner' ? 'selected':'' }}>Owner</option>
                <option value="veterinarian"  {{ old('role')==='veterinarian' ? 'selected':'' }}>Veterinarian</option>
            </select>
            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Owner extra fields --}}
        <div id="ownerFields" class="border col-md-6" style="display:none;">
            <h5>Owner Details</h5>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror" value="{{ old('owner_phone') }}">
                @error('owner_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="owner_address" class="form-control @error('owner_address') is-invalid @enderror" value="{{ old('owner_address') }}">
                @error('owner_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        {{-- Veterinarian extra fields --}}
        <div id="vetFields" class="border col-md-6" style="display:none;">
            <h5>Veterinarian Details</h5>
            <div class="mb-3">
                <label>Name (for clinic display)</label>
                <input type="text" name="vet_name" class="form-control @error('vet_name') is-invalid @enderror" value="{{ old('vet_name') }}">
                {{--@error('vet_name') <div class="invalid-feedback">{{ $message }}</div> @enderror--}}
            </div>

            <div class="mb-3 ">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="vet_phone" class="form-control @error('vet_phone') is-invalid @enderror" value="{{ old('vet_phone') }}">
                @error('vet_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 ">
                <label for="license_number" class="form-label">License Number</label>
                <input type="text" name="license_number" class="form-control @error('license_number') is-invalid @enderror" value="{{ old('license_number') }}">
                @error('license_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 ">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" name="specialization" class="form-control @error('specialization') is-invalid @enderror" value="{{ old('specialization') }}">
                @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div> 
        
        <div class="col-12">
            <button type="submit" id="saveUserBtn" class="btn btn-success btn-lg">
                <i class="bx bx-save me-1"></i> Add User
            </button>
        </div>
    </form>
</div>

{{-- Toggle JS --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const roleSelect = document.getElementById('roleSelect');
    const ownerFields = document.getElementById('ownerFields');
    const vetFields   = document.getElementById('vetFields');
   

    function toggleSections(){
        const role    = roleSelect.value;
        const isOwner = role === 'owner';
        const isVet   = role === 'veterinarian';

        // Show/hide panels
        ownerFields.style.display = isOwner ? 'block' : 'none';
        vetFields.style.display   = isVet   ? 'block' : 'none';

        // Enable/disable every input/select/textarea inside each panel
        ownerFields.querySelectorAll('input, select, textarea').forEach(el => {
        el.disabled = !isOwner;
        });
        vetFields.querySelectorAll('input, select, textarea').forEach(el => {
        el.disabled = !isVet;
        });
    }

  roleSelect.addEventListener('change', toggleSections);
  toggleSections(); // initial setup for old() values

  const form     = document.getElementById('userForm');
  const saveBtn  = document.getElementById('saveUserBtn');

  saveBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Show confirmation dialog
    Swal.fire({
      title: 'Confirm Creation',
      text: 'Do you want to save this new user?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Yes, save it',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // Manually submit the form
        form.submit();
      }
    });
  });

  // Post-redirect success alert
  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Saved!',
      text: "{{ session('success') }}",
      confirmButtonText: 'OK'
    });
  @endif
});
</script>
@endpush
@endsection