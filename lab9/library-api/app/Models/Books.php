<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['title', 'description', 'year_of_publication', 'author_id', 'genre_id'];
}
