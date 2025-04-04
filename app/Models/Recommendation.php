<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'image',
        'tags',
        'ciudad',
        'enlace',
        'autor',
        'lat',
        'lng'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y',
    ];

    /**
     * Obtiene el usuario que posee esta recomendación.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene las etiquetas asociadas a esta recomendación (si es que implementas etiquetas).
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function recinto(): HasOne {
        return $this->hasOne(Recinto::class);
    }
}
