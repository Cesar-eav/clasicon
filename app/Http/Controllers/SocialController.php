<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Follower;
use Illuminate\Http\Request;
use App\Models\Recommendation;

class SocialController extends Controller
{

    public function profile($user_id){

        
        // $user = auth();
        $user = User::where('id', $user_id)->first();
     
        $clasicones = Recommendation::with('user')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')->get()
            ->toArray();
        $followers = auth()->user()->followers()->with('follower')->get();


        // return $mis_clasicones;


         return Inertia::render('Social/Profile',[
            'user' => $user,
            'clasicones' => $clasicones,
            'followers' => $followers

         ]);

    }

    public function followers()
    {
        $followers = auth()->user()->followers()->with('follower')->get();


        return Inertia::render('Social/Followers', [
            'followers' => $followers,
        ]);
    }

    public function following()
    {
        $following = auth()->user()->following()->with('user')->get();

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
