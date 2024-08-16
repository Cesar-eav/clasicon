<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GptRecommendation;

class GptRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Inserta cada registro de la lista
        GptRecommendation::factory()->count(1000)->create();
    }
}
