@extends('dashboard.admin.layout')

@section('title', 'Pet Records')

@section('content')
<div class="container-fluid py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 mb-0">All Pets</h2>
    @if(auth()->user()->role === 'owner')
      <a href="{{ route('admin.pets.create') }}" class="btn btn-success">
        <i class="bx bx-plus me-1"></i> Add Pet
      </a>
    @endif
    <a href="{{ route('admin.pets.export') }}" class="btn btn-outline-dark">
        <i class="bx bx-download me-1"></i> Export CSV
    </a>
  </div>

  <form method="GET" class="mb-3 d-flex align-items-center">
        <label class="me-2">Filter by species:</label>
        <select name="species" class="form-select w-auto me-2">
            <option value="">All</option>
            @foreach(['dog', 'cat', 'bird', 'other'] as $type)
            <option value="{{ $type }}" {{ request('species') === $type ? 'selected' : '' }}>
                {{ ucfirst($type) }}
            </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-outline-primary">Apply</button>
    </form>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Name</th>
        <th>Species</th>
        <th>Breed</th>
        <th>Sex</th>
        <th>Birthdate</th>
        <th>Owner</th>
        <th>Appointments</th>
        <th>Next Appointment</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>
      @forelse($pets as $pet)
        <tr>
          <td>{{ $pet->name }}</td>
          <td>{{ ucfirst($pet->species) }}</td>
          <td>{{ $pet->breed }}</td>
          <td>{{ ucfirst($pet->sex) }}</td>
          <td>{{ \Carbon\Carbon::parse($pet->birthdate)->format('M d, Y') }}</td>
          <td>{{ $pet->owner->user->name ?? '—' }}</td>
          <td>@if($pet->appointments->count()) 
            <span class="badge bg-success"> {{ $pet->appointments->count() }} active </span>
                @else 
            <span class="badge bg-secondary">None</span> 
                @endif
          </td>
          <td>{{ optional($pet->appointments->sortBy('date')->first())->date ?? '—' }}</td>
          <td>{{ $pet->created_at->diffForHumans() }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="text-center text-muted">No pets found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $pets->links() }}
  </div>
</div>
@endsection