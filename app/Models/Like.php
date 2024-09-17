<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    use HasFactory;
    
    protected $fillable = ['user_id', 'recommendation_id'];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con la recomendación
    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }

}
