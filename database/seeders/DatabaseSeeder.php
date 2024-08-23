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
        $this->call(UserSeeder::class);
        $this->call(RecommendationSeeder::class);
        $this->call(GptRecommendationSeeder::class);
    }
    

}
