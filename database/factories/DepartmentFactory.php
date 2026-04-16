<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

// Factory: DepartmentFactory
// Purpose: Generates fake data for the Department model for testing and seeding.

class DepartmentFactory extends Factory
{
   
    public function definition(): array
    {

        $names= ['Wind', 'Sun', 'Water', 'Earth', 'Light', 'Darkness', 'Stars', 'Animals', 'Trees', 'People'];

        return [
            'name' => $this->faker->unique()->randomElement($names),
            'user_id' => User::factory(),
           
        ];
    }
}
