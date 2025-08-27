@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto py-8">
  <h1 class="text-2xl font-bold mb-6">Edit Your Profile</h1>

  @if(session('status'))
    <div class="mb-4 text-green-600">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-4">
      <label for="name" class="block font-medium">Name</label>
      <input id="name" name="name" type="text"
             class="mt-1 block w-full border rounded"
             value="{{ old('name', auth()->user()->name) }}"
             required>
      @error('name')
        <span class="text-red-600 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="mb-4">
      <label for="email" class="block font-medium">Email</label>
      <input id="email" name="email" type="email"
             class="mt-1 block w-full border rounded"
             value="{{ old('email', auth()->user()->email) }}"
             required>
      @error('email')
        <span class="text-red-600 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded">
      Save Changes
    </button>
  </form>
</div>
@endsection