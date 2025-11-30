<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- Create 3 specific role users ---
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'administrator',
        ]);

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'role' => 'manager',
        ]);

        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'role' => 'user',
        ]);

       

        // --- Assign departments and products to each user ---
        $allUsers = collect([$admin, $manager, $user]);

        $allUsers->each(function (User $u) {
            // Each user gets 2–3 departments
            Department::factory()
                ->count(fake()->numberBetween(2, 3))
                ->for($u)
                ->create()
                ->each(function (Department $dept) use ($u) {
                    // Each department gets 5–15 products
                    Product::factory()
                        ->count(fake()->numberBetween(5, 15))
                        ->for($dept)
                        ->for($u)
                        ->create();
                });
        });
    }
}
