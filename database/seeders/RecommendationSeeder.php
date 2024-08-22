<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommendation;

class RecommendationSeeder extends Seeder
{
    public function run(): void
    {

        // Genera 50 recomendaciones usando la factory
        Recommendation::factory()->count(50)->create();
    }
}
