<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition()
    {
        $species = ['dog','cat','rabbit','bird'];
        return [
            'owner_id'  => Owner::factory(),
            'name'      => $this->faker->firstName(),
            'species'   => $this->faker->randomElement($species),
            'breed'     => $this->faker->optional()->word(),
            'birthdate' => $this->faker->date(),
            'sex'       => $this->faker->optional()->randomElement(['male','female']),
        ];
    }
}