<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;

// Factory: ProductFactory
// Purpose: Generates fake data for the Product model for testing and seeding.

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = Str::headline($this->faker->words(2, true));   
        $sku  = $this->faker->unique()->bothify('SKU-#####-??');

        
       $imageUrl = 'https://placehold.co/600x400?text=' . urlencode($name);
        
       
        return [
            'name'        => $name,
            'price'       => $this->faker->randomFloat(2, 5, 500), 
            'description' => $this->faker->paragraph(4),
            'item_number' => $sku,
            'image_url'   => $imageUrl,
            'department_id' => Department::factory(),  
         ];
    }
}