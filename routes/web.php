<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\PointsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard',  

// function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::post('/profile/settings', [ProfileController::class, 'update'])->name('profile.updateSettings');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Recommendations
    Route::resource('recommendations', RecommendationController::class)->except(['show']);
    Route::get('recommendations/explore', [RecommendationController::class, 'explore'])->name('recommendations.explore');

    // Social Interaction
    Route::get('social/followers', [SocialController::class, 'followers'])->name('social.followers');
    Route::get('social/following', [SocialController::class, 'following'])->name('social.following');
    Route::get('social/notifications', [SocialController::class, 'notifications'])->name('social.notifications');

    // Points and Achievements
    Route::get('profile/achievements', [AchievementController::class, 'index'])->name('profile.achievements');
    Route::get('profile/points', [PointsController::class, 'index'])->name('profile.points');

    // Logout
    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');

});

require __DIR__ . '/auth.php';
