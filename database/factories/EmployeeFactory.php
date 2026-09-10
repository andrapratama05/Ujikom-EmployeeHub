<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');

        return [
            'name' => $faker->name(),
            'sex' => $faker->randomElement(['L', 'P']),
            'age' => $faker->numberBetween(20, 60),
            'last_education' => $faker->randomElement(['SMA', 'D3', 'D4', 'S1', 'S2']),
        ];
    }
}
