<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\Thought;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller

{
    public function index()
    {
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])->orderBy('created_at', 'desc')->get();
        $userId = auth()->id(); 
        $thoughts = Thought::with("user")->get();
        


        $recommendations_organic->each(function ($recommendation) use ($userId) {
            $recommendation->is_following = $recommendation->user->followers->contains('follower_id', $userId);
        });


        return Inertia::render('Dashboard', [
            'recommendations_organic' => $recommendations_organic,
            'auth_user_id' => $userId,
            'thoughts' => $thoughts
        ]);
    }

    public function welcome()
    {
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])
        ->inRandomOrder()
        ->limit(30)
        ->get();
        $userId = auth()->id(); 

        return Inertia::render('Welcome',[
            'recommendations_organic' => $recommendations_organic,
            'auth_user_id' => $userId
        ]);
    }
}
