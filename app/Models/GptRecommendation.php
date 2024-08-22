<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GptRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [        
        'title',
        'category',
        'description',
        'user',
        'image'
    ];
}
