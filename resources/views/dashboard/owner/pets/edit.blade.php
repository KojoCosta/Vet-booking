@extends('dashboard.owner.layout')

@section('content')
<h4 class="mb-4">Edit Pet</h4>

<form method="POST" action="{{ route('owner.pets.update', $pet) }}">
  @csrf
  @method('PUT')

  @include('dashboard.owner.pets._form', ['pet' => $pet])

  <button type="submit" class="btn btn-outline-success">Update Pet</button>
</form>
@endsection