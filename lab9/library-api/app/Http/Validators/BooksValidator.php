<?php

namespace App\Http\Validators;

class BooksValidator
{
    public static array $rules = [
        'title' => ['required', 'string', 'unique:books', 'max:255'],
        'description' => ['required', 'string', 'max:2048'],
        'year_of_publication' => ['required', 'integer', 'lte:2024'],
        'author_id' => ['required', 'integer', 'exists:authors,id'],
        'genre_id' => ['required', 'integer', 'exists:genres,id']
    ];
}
