<?php

namespace App\Http\Livewire\Vet;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentReaction;
use App\Models\Veterinarian;
use Illuminate\Support\Facades\Auth;

class AppointmentList extends Component
{
    public $statusFilter = 'all';
    public $appointments = [];
    public $statusReactions = [];

    public function mount()
    {
        if (!Auth::user()->isVeterinarian()) {
            abort(403);
        }

        $this->loadAppointments();
    }

    public function render()
    {
        return view('livewire.vet.appointment-list', [
            'appointments' => $this->appointments,
        ]);
    }

    public function updateReaction($appointmentId, $newStatus)
    {
        $validStatuses = [
            AppointmentReaction::STATUS_PENDING,
            AppointmentReaction::STATUS_APPROVED,
            AppointmentReaction::STATUS_DECLINED,
        ];

        if (!in_array($newStatus, $validStatuses, true)) {
            session()->flash('error', 'Invalid reaction status.');
            return;
        }

        $vet = Veterinarian::where('user_id', Auth::id())->firstOrFail();
        $appointment = Appointment::where('vet_id', $vet->id)->findOrFail($appointmentId);

        // Optionally update appointment status if needed
        $appointment->save();

        AppointmentReaction::updateOrCreate(
            ['appointment_id' => $appointmentId],
            ['status' => $newStatus]
        );

        $this->loadAppointments();

        session()->flash('success', 'Reaction updated to ' . ucfirst($newStatus));
    }

    public function updatedStatusFilter()
    {
        $this->loadAppointments();
    }

    private function loadAppointments()
    {
        $vet = Veterinarian::where('user_id', Auth::id())->firstOrFail();

        $this->appointments = Appointment::where('vet_id', $vet->id)
            ->with(['pet.owner.user', 'reaction'])
            ->when($this->statusFilter !== 'all', fn($q) => $q->whereHas('reaction', fn($r) => $r->where('status', $this->statusFilter)))
            ->orderBy('scheduled_at', 'asc')
            ->get();
    }

    public function updateAppointmentStatus($appointmentId, $newStatus)
    {
        $validStatuses = [
            Appointment::STATUS_PENDING,
            Appointment::STATUS_CONFIRMED,
            Appointment::STATUS_CANCELED,
        ];

        if (!in_array($newStatus, $validStatuses, true)) {
            session()->flash('error', 'Invalid appointment status.');
            return;
        }

        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->status = $newStatus;
        $appointment->save();

        $this->loadAppointments();
        session()->flash('success', 'Appointment status updated to ' . ucfirst($newStatus));
    }
}