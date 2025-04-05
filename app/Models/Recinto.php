<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


    class Recinto extends Model {
        protected $fillable = [
            'recommendation_id',
            'opening_hours',
            'entry_fee',
            'type',
        ];
    
        public function recommendation(): BelongsTo {
            return $this->belongsTo(Recommendation::class);
        }
}
