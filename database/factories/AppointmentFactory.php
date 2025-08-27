<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Pet;
use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        $statuses = ['pending','confirmed','canceled'];
        return [
            'pet_id'        => Pet::factory(),
            'vet_id'        => Veterinarian::factory(),
            'scheduled_at'  => $this->faker->dateTimeBetween('-1 month','+1 month'),
            'status'        => $this->faker->randomElement($statuses),
            'notes'         => $this->faker->optional()->sentence(),
        ];
    }
}