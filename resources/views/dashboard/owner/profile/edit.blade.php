@extends('dashboard.owner.layout')

@section('content')
<div class="container">
  <h4>Edit Profile</h4>
  <form method="POST" action="{{ route('owner.profile.update') }}">
    @csrf @method('PUT')

    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
    </div>

    <div class="mb-3">
      <label>New Password</label>
      <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-outline-primary">Update Profile</button>
  </form>
</div>
@endsection