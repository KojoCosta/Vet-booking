@extends('dashboard.veterinarian.layout')

@section('title', 'Veterinarian Dashboard')

@section('content')
<div class="container-fluid py-4">
    <h2 class="h4 mb-4">Welcome, Dr. {{ auth()->user()->name }}</h2>

    {{-- Veterinarian Details --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Your Profile</h5>
            <p><strong>Name (as used in the clinic):</strong> {{ $vet->vet_name ?? 'Not set' }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Specialty:</strong> {{ $vet->specialization ?? 'Not set' }}</p>
            <p><strong>Phone:</strong> {{ $vet->phone ?? 'Not set' }}</p>
        </div>
    </div>

    {{-- Appointment Summary --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Appointments Overview</h5>
            <p><strong>Total Appointments:</strong> {{ $appointmentCount }}</p>
        </div>
    </div>
</div>

{{-- Appointment Status Breakdown --}}
<div class="row mb-4">
    @php
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $colors = ['warning', 'primary', 'success', 'danger'];
    @endphp

    @foreach ($statuses as $index => $status)
        <div class="col-md-3 mb-3">
            <div class="card border-{{ $colors[$index] }}">
                <div class="card-body text-center">
                    <h6 class="text-uppercase text-{{ $colors[$index] }}">{{ ucfirst($status) }}</h6>
                    <h3 class="fw-bold">{{ $statusCounts[$status] ?? 0 }}</h3>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection