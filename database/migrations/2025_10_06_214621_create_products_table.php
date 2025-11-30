<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Migration: CreateDepartmentsTable
//  Defines the schema for the departments table in the database.

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->string('item_number')->unique()->index();
            $table->string('image_url')->nullable();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
