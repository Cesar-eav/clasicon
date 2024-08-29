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
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])->orderBy('created_at', 'desc')->get();
        $userId = auth()->id(); 

        $recommendations_organic->each(function ($recommendation) use ($userId) {
            $recommendation->is_following = $recommendation->user->followers->contains('follower_id', $userId);
        });


        return Inertia::render('Dashboard', [
            'recommendations_organic' => $recommendations_organic,
            'auth_user_id' => $userId
        ]);
    }

    public function welcome()
    {

        return Inertia::render('Welcome');
    }
}
