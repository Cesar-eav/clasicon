<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Follower;
use App\Models\User;

class SocialController extends Controller
{
    public function followers()
    {
        $followers = auth()->user()->followers()->with('follower')->get();


        return Inertia::render('Social/Followers', [
            'followers' => $followers,
        ]);
    }

    public function following()
    {
        $following = auth()->user()->following;

        return Inertia::render('Social/Following', [
            'following' => $following,
        ]);
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications;

        return Inertia::render('Social/Notifications', [
            'notifications' => $notifications,
        ]);
    }

    public function follow(User $user)
    {
        $follower = auth()->user()->following()->where('user_id', $user->id)->first();

        if (!$follower) {
            Follower::create([
                'user_id' => $user->id,
                'follower_id' => auth()->id(),
            ]);
        }

        return back(); // O puedes usar una redirección personalizada
    }

    public function unfollow(User $user)
    {
        $follower = auth()->user()->following()->where('user_id', $user->id)->first();

        if ($follower) {
            $follower->delete();
        }

        return back(); // O puedes usar una redirección personalizada
    }
}
