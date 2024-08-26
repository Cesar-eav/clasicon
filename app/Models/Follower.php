<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Get the user that is being followed.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the follower (the user who is following).
     */
    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
}
