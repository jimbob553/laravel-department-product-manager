<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class ProductValidator
{
    public static function validate($data, $productId = null)
    {
        $rules = [
            'department_id' => 'required|exists:departments,id',
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'item_number' => 'required|string|max:255|unique:products,item_number' . ($productId ? ",$productId" : ''),
            'description' => 'nullable|string',
            'image_url'   => 'nullable|string|max:255',
        ];

        return Validator::make($data, $rules)->validate();
    }
}