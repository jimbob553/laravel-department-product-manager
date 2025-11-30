<?php

namespace App\Models;   

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * =============================================================
 *  Model: Department
 *  Purpose: Represents a department in the Bigfoot Bookstore.
 *            Each department can have many products and serves
 *            as a category for organizing inventory.
 *
 *  Relationships:
 *   • hasMany Products
 *
 *  Database Table: departments
 * =============================================================
 */

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
        ];
        

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}