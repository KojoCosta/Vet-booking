@extends('dashboard.owner.layout')

@section('content')
<h4 class="mb-4">Add a New Pet</h4>

@if($errors->any())
  <div class="alert alert-danger">
    <strong>There were some problems with your input:</strong>
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('owner.pets.store') }}">
  @csrf

   @include('dashboard.owner.pets._form', ['pet' => null])


  <button type="submit" class="btn btn-success">Save Pet</button>
</form>
@endsection