<?php

namespace App\Http\Validators;

class AuthorsValidator
{
    public static array $rules = [
        'name' => ['required', 'string', 'unique:authors', 'max:128'],
        'surname' => ['required', 'string', 'max:128'],
        'biography' => ['required', 'string', 'max:2048'],
    ];
}
