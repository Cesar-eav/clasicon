<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GptRecommendation;

class GptRecommendationSeeder extends Seeder
{

    public function run(): void
    {
        // Inserta cada registro de la lista
        GptRecommendation::factory()->count(50)->create();
    }
}
