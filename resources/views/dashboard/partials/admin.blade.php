<div class="row">
  <x-stat-card title="Owners" :value="App\Models\Owner::count()" route="owners.index" />
  <x-stat-card title="Pets"   :value="App\Models\Pet::count()"   route="pets.index" />
  <x-stat-card title="Appointments" 
               :value="App\Models\Appointment::count()" 
               route="appointments.index" />
  <x-stat-card title="Vets"    :value="App\Models\Veterinarian::count()" 
               route="veterinarians.index" />
</div>

<h2 class="mt-5">Recent Appointments</h2>
<table class="table">
  <thead>
    <tr><th>When</th><th>Pet</th><th>Owner</th><th>Vet</th><th>Status</th></tr>
  </thead>
  <tbody>
    @foreach(App\Models\Appointment::latest()->take(5)->get() as $appt)
      <tr>
        <td>{{ $appt->start_time->format('M d, Y H:i') }}</td>
        <td>{{ $appt->pet->name }}</td>
        <td>{{ $appt->owner->fullName }}</td>
        <td>{{ $appt->veterinarian->fullName }}</td>
        <td>{{ ucfirst($appt->status) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>