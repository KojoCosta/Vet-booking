<?php

namespace Database\Factories;

use App\Models\Veterinarian;
use Illuminate\Database\Eloquent\Factories\Factory;

class VeterinarianFactory extends Factory
{
    protected $model = Veterinarian::class;

    public function definition(): array
    {
        return [
            'phone'          => $this->faker->phoneNumber(),
            'license_number' => strtoupper('LIC-' . $this->faker->unique()->numerify('2025-####')),
            'specialization' => $this->faker->randomElement([
                'Surgery', 'Dentistry', 'Dermatology', 'Radiology', 'General Care',
            ]),
            // no 'name', no 'email'
        ];
    }
}