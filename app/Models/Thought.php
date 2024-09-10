<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Thought::class, 'parent_id');
    }

    // Obtener las respuestas (pensamientos hijos)
    public function replies()
    {
        return $this->hasMany(Thought::class, 'parent_id');
    }
}
