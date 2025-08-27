@extends('dashboard.admin.layout')

@section('content')
<div class="container-fluid">

    {{-- Header with title and “Add Member” button --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Manage Members</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bx bx-user-plus me-1"></i> Add Member
        </a>
    </div>

            {{-- Filters: Search + Role + Status --}}
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-5">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search by name or email..."
                value="{{ request('search') }}"
            >
            </div>
            <div class="col-md-3">
            <select name="role" class="form-select">
                <option value="">All Roles</option>
                @foreach($roles as $r)
                <option value="{{ $r }}" {{ request('role') === $r ? 'selected' : '' }}>
                    {{ ucfirst($r) }}
                </option>
                @endforeach
            </select>
            </div>
            {{--<div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                @foreach($statuses as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                    {{ ucfirst($s) }}
                </option>
                @endforeach
            </select>
            </div>--}}
            <div class="col-md-1 d-grid">
            <button type="submit" class="btn btn-outline-info">
                <i class="bx bx-filter"></i> Filter
            </button>
            </div>
        </form>


    {{-- Card grid --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($users as $user)
        <div class="col">
            <div class="card h-100 shadow-sm text-center">
                <div class="card-body text-center">
                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default.jpg') }}" alt="Avatar of {{ $user->name }}"
                        class="rounded-circle mt-3" width="90" height="90" >
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $user->name }}</h5>
                        <p class="card-text text-muted mb-2">{{ $user->email }}</p>
                        <span class="badge bg-secondary mb-3">{{ ucfirst($user->role) }}</span>
                        <div>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" >
                                <i class="bx bx-pencil-square me-1"></i> Edit Member
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-danger text-center mb-0">
            No members found matching your search.
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination (preserves search query) --}}
    <div class="mt-4">
        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection