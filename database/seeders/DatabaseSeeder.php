<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    // Create admin
    $this->call(CreateAdminSeeder::class);

    $admin = \App\Models\User::first();

    \App\Models\Department::factory(5)->create([
        'user_id' => $admin->id,
    ]);

    \App\Models\Product::factory(20)->create();
}
    
}
