<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;

class DepartmentValidator
{
    public static function validate($data)
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        return Validator::make($data, $rules)->validate();
    }
}
