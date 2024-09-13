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
        // Obtener las recomendaciones con las relaciones necesarias
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])->orderBy('created_at', 'desc')->get();
        $userId = auth()->id();
        $thoughts = Thought::all();

        // Añadir el campo is_following a las recomendaciones antes de combinarlas
        $recommendations_organic->each(function ($recommendation) use ($userId) {
            $recommendation->is_following = $recommendation->user->followers->contains('follower_id', $userId);
        });

        // Combinar recomendaciones y pensamientos, y luego barajarlos
        $combined = $recommendations_organic->concat($thoughts)->shuffle();
        // return $combined;
        // Enviar los datos combinados a la vista
        return Inertia::render('Dashboard', [
            'auth_user_id' => $userId,
            'combined' => $combined
        ]);
    }

    public function welcome()
    {
        $recommendations_organic = Recommendation::with(['user', 'comments.user'])
            ->inRandomOrder()
            ->limit(30)
            ->get();
        $userId = auth()->id();

        return Inertia::render('Welcome', [
            'recommendations_organic' => $recommendations_organic,
            'auth_user_id' => $userId
        ]);
    }
}
