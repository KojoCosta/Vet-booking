@extends('dashboard.owner.layout')

@section('content')
<h4 class="mb-4">My Pets</h4>

{{-- Filter by species --}}
<form method="GET" class="mb-3">
  <div class="input-group" style="max-width: 300px;">
    <select name="species" class="form-select" onchange="this.form.submit()" aria-label="Filter by species">
      <option value="">All Species</option>
      @foreach($speciesList as $type)
        <option value="{{ $type }}" {{ $species === $type ? 'selected' : '' }}>
          {{ \Illuminate\Support\Str::title($type) }}
        </option>
      @endforeach
    </select>
    @if($species)
      <a href="{{ route('owner.pets.index') }}" class="btn btn-outline-secondary">Reset</a>
    @endif
  </div>
</form>

{{-- Add Pet Button --}}
<a href="{{ route('owner.pets.create') }}" class="btn btn-primary mb-3">
  <i class="bx bx-plus-circle me-1"></i> Add Pet
</a>

{{-- Pets Table --}}
<table class="table table-bordered table-hover">
  <thead class="table-light">
    <tr>
      <th>Name</th>
      <th>Species</th>
      <th>Breed</th>
      <th>Sex</th>
      <th>Birthdate</th>
      <th class="text-center">Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse($pets as $pet)
      <tr>
        <td>{{ $pet->name }}</td>
        <td>{{ ucfirst($pet->species) }}</td>
        <td>{{ $pet->breed ?? '—' }}</td>
        <td>{{ ucfirst($pet->sex) }}</td>
        <td>{{ $pet->birthdate ? \Carbon\Carbon::parse($pet->birthdate)->format('M d, Y') : '—' }}</td>
        <td class="text-center">
          <a href="{{ route('owner.pets.edit', $pet) }}"
             class="btn btn-sm btn-outline-primary me-2"
             aria-label="Edit {{ $pet->name }}">
            <i class="bx bx-edit"></i>
          </a>

          <form method="POST"
                action="{{ route('owner.pets.destroy', $pet) }}"
                class="d-inline"
                onsubmit="return confirm('Delete {{ $pet->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-outline-danger"
                    aria-label="Delete {{ $pet->name }}">
              <i class="bx bx-trash"></i>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" class="text-muted text-center">No pets found.</td>
      </tr>
    @endforelse
  </tbody>
</table>

{{-- Optional Pagination --}}
{{-- Uncomment if using paginate() in controller --}}
{{-- <div class="mt-3">{{ $pets->links() }}</div> --}}
@endsection