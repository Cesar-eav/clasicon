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
        $userId = auth()->id();
        // Obtener las recomendaciones con las relaciones necesarias
        $recommendations_organic = Recommendation::with(['user', 'comments.user', 'likes'])
        ->where('user_id', '!=',$userId)
        ->orderBy('created_at', 'desc')->get();
        $thoughts = Thought::all();

        // Añadir el campo is_following a las recomendaciones antes de combinarlas
        $recommendations_organic->each(function ($recommendation) use ($userId) {
            $recommendation->is_following = $recommendation->user->followers->contains('follower_id', $userId);

            // Contar los "me gusta" y verificar si el usuario autenticado ya le dio "me gusta"
            $recommendation->likes_count = $recommendation->likes->count();
            $recommendation->liked_by_user = $recommendation->likes->contains('user_id', $userId);
        });

        // Combinar recomendaciones y pensamientos, y luego barajarlos
        $combined = $recommendations_organic->concat($thoughts)->shuffle();

        return Inertia::render('Dashboard', [
            'auth_user_id' => $userId,
            'combined' => $combined
        ]);
    }

    public function welcome()
    {
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])
            ->inRandomOrder()
            // ->limit(30)
            ->get();
        $userId = auth()->id();

        return Inertia::render('Welcome', [
            'recommendations_organic' => $recommendations_organic,
            'auth_user_id' => $userId
        ]);
    }

    public function sideBar()
    {
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])
            ->inRandomOrder()
            ->get();

        $userId = auth()->id();

        return Inertia::render('SidebarContent', [
            'recommendations' => $recommendations,
            'auth_user_id' => $userId
        ]);
    }
}
