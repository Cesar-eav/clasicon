<?php

use Inertia\Inertia;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThoughtController;
use App\Http\Controllers\PoliticaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecommendationController;

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
    return redirect()->route('welcome');
});


Route::get('politica-de-privacidad', [PoliticaController::class, 'privacidad'])->name('social.privacidad');
Route::get('eliminacion-de-datos', [PoliticaController::class, 'datos'])->name('social.eliminacion-datos');
Route::get('/', [DashboardController::class, 'welcome'])->name('welcome');

Route::get('/search-recommendations', [SearchController::class, 'search']);
Route::get('/search-results', [SearchController::class, 'showSearchResults'])->name('search.results');

Route::get('/api/recommendations/random', [RecommendationController::class, 'getRandomRecommendations']);
Route::get('/recommendations/clasicon/{clasicon_id}', [SearchController::class, 'clasicon'])->name('social.clasicon');



// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/myprofile', [ProfileController::class, 'myprofile'])->name('profile.myprofile');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
    Route::post('/profile/settings', [ProfileController::class, 'update'])->name('profile.updateSettings');

    // Profile Settings
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 
    Route::resource('recommendations', RecommendationController::class)->except(['show']);
    Route::post('/recommendations/store', [RecommendationController::class, 'store'])->name('recommendations.store');
    Route::post('/recommendations/{recommendation}', [RecommendationController::class, 'update'])->name('recommendations.update');
    Route::get('/recommendations/{recommendation}/edit', [RecommendationController::class, 'edit'])->name('recommendations.edit');
    Route::post('/recommendations/{recommendation}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/recommendations/{recommendation}/comments/{comment}', [CommentController::class, 'show']);

    Route::get('recommendations/explore', [RecommendationController::class, 'explore'])->name('recommendations.explore');
    Route::delete('/recommendations/{id}', [RecommendationController::class, 'destroy'])->name('recommendations.destroy');




    Route::post('/thoughts', [ThoughtController::class, 'store'])->middleware('auth');





    
    // Social 
    Route::get('/social/profie/{user_id}', [SocialController::class, 'profile'])->name('social.profile');
    Route::get('social/followers', [SocialController::class, 'followers'])->name('social.followers');
    Route::get('social/following', [SocialController::class, 'following'])->name('social.following');
    Route::get('social/notifications', [SocialController::class, 'notifications'])->name('social.notifications');
    Route::post('/social/follow/{user}', [SocialController::class, 'follow'])->name('social.follow');
    Route::post('/social/unfollow/{user}', [SocialController::class, 'unfollow'])->name('social.unfollow');

    //LINKES
    Route::post('/recommendation/{id}/like', [SocialController::class, 'likePost'])->name('recommendation.like');
    Route::post('/recommendation/{id}/unlike', [SocialController::class, 'unlikePost'])->name('recommendation.unlike');

        
    // Points and Achievements
    Route::get('profile/achievements', [AchievementController::class, 'index'])->name('profile.achievements');
    Route::get('profile/points', [PointsController::class, 'index'])->name('profile.points');

    // Logout
    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');


    // Route::post('/api/notifications/{id}/mark-as-read', function ($id) {
    //     $notification = auth()->user()->notifications()->find($id);
    //     if ($notification) {
    //         $notification->markAsRead();
    //     }
    //     return response()->json(['status' => 'success']);
    // });

    Route::get('/api/notifications', [NotificationController::class, 'index']);
    Route::get('/api/notifications/unread', [NotificationController::class, 'getUnreadNotifications']);

    Route::post('/api/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);




});


require __DIR__ . '/auth.php';
