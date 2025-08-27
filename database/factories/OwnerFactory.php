<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * The name of the factory’s corresponding model.
     */
    protected $model = Owner::class;

    /**
     * Define the model’s default state.
     */
    public function definition(): array
    {
        return [
            'phone'   => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}