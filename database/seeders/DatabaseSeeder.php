<?php

namespace Database\Seeders;

use App\Models\User;
// use Database\Seeders\RecommendationSeeder;
use App\Models\Recommendation;
use Illuminate\Database\Seeder;
use App\Models\GptRecommendation;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \App\Models\Recommendation::truncate();
        \App\Models\GptRecommendation::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(RecommendationSeeder::class);

        $this->call(GptRecommendationSeeder::class);

    }
    

}
