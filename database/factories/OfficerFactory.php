<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Officer>
 */
class OfficerFactory extends Factory
{
    protected $model = Officer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'officer_name' => fake()->name(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'dob' => fake()->date('Y-m-d', '-22 years'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '+855 '.fake()->numerify('## ### ###'),
            'address' => fake()->address(),
            'hire_date' => fake()->date('Y-m-d', '-1 years'),
            'salary' => fake()->randomFloat(2, 600, 3500),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Resigned']),
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
        ];
    }
}
