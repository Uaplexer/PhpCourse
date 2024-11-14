<?php

namespace App\Http\Validators;
class GenresValidator
{
    public static array $rules = [
        'name' => ['required', 'string', 'unique:genres', 'max:255'],
        'description' => ['required', 'string', 'max:1024']
    ];
}
