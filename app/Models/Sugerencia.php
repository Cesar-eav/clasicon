<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ciudad',
        'lat',
        'lng',
        'enlace',
        'autor',
        'description',
        'category',
        'image',
        'tags',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
