<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function index()
    {
        $recommendations = Recommendation::with('user')->orderBy('created_at', 'desc')->get();

        return Inertia::render('Dashboard', [
            'recommendations' => $recommendations,
        ]);
    }

    public function welcome()
    {

        return Inertia::render('Welcome');
    }
}
