<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentReaction;
use Illuminate\Support\Facades\Auth;

class AppointmentList extends Component
{
    public $appointments = [];
    public $statusFilter = 'all';
    public $statusReactions = [];

    public function mount()
    {
        if (!auth()->user()?->isAdmin()) {
            abort(403);
        }

        $this->loadAppointments();
    }

    public function render()
    {
        return view('livewire.admin.appointment-list');
    }

    public function updateReactionStatus($appointmentId, $newStatus)
    {
        if (!AppointmentReaction::isValidStatus($newStatus)) {
            session()->flash('error', 'Invalid reaction status.');
            return;
        }

        AppointmentReaction::updateOrCreate(
            ['appointment_id' => $appointmentId],
            ['status' => $newStatus]
        );

        $this->loadAppointments();
        session()->flash('success', 'Reaction updated.');
    }

    public function updatedStatusFilter()
    {
        $this->loadAppointments();
    }

    private function loadAppointments()
    {
        $query = Appointment::with(['pet.owner.user', 'veterinarian.user', 'reaction']);

        if ($this->statusFilter !== 'all') {
            $query->whereHas('reaction', fn($q) => $q->where('status', $this->statusFilter));
        }

        $this->appointments = $query->orderBy('scheduled_at')->get();
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