@extends('dashboard.veterinarian.layout')

@section('title', 'Edit Profile')

@section('content')
<div class="container py-4">
    <h2>Edit Profile</h2>

    <form method="POST" action="{{ route('veterinarian.profile.update') }}">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="{{ old('name', auth()->user()->name) }}">
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="{{ old('email', auth()->user()->email) }}">
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection