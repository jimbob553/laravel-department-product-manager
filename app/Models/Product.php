<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * =============================================================
 *  Model: Product
 *  Purpose: Represents a product within the Bigfoot Bookstore app.
 *            Each product belongs to one department and includes
 *            details such as name, price, description, image URL,
 *            and an automatically generated item number.
 *
 *  Relationships:
 *   • belongsTo Department
 *
 *  Database Table: products
 * =============================================================
 */

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'department_id',
        'user_id',
        'name',
        'price',
        'description',
        'item_number',
        'image_url',
    ];

     protected $casts = [
        'price' => 'decimal:2',
    ];
    
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

}
