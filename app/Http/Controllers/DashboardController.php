<?php

namespace App\Http\Controllers;
use App\Models\Recommendation;
use Inertia\Inertia;

class DashboardController extends Controller

{
    public function index()
    {
        $recommendations = Recommendation::inRandomOrder()->limit(5)->get();

        return Inertia::render('Dashboard', [
            'recommendations' => $recommendations,
        ]);
    }
}
