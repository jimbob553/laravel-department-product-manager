<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $this->call(CreateAdminSeeder::class);

        // Fake Departments
        \App\Models\Department::factory(5)->create();

        // Fake Products
        \App\Models\Product::factory(20)->create();
    }
}
