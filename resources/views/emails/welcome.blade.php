<!-- resources/views/emails/welcome.blade.php -->
@component('mail::message')
# Welcome, {{ $user->name }}!

You’ve been registered as a **{{ ucfirst($user->role) }}** on VetBooking.  

@if($user->role === 'admin')
As an admin you can manage users, appointments, and site settings.
@elseif($user->role === 'owner')
Log in to manage your pets’ profiles and schedule appointments.
@elseif($user->role === 'veterinarian')
Your clinic dashboard is ready—view and confirm new appointment requests.
@endif

@component('mail::button', ['url' => route('login')])
Log in to VetBooking
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent