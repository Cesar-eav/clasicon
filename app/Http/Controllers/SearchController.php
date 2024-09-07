<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\User;
use App\Models\Follower;
use Inertia\Inertia;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la tabla de recomendaciones
        $results = Recommendation::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->orWhere('tags', 'LIKE', "%{$query}%")
                    ->get();

        return response()->json($results);
    }


    public function clasicon($clasicon_id){

        
     
        $clasicones = Recommendation::with('user')
            ->where('id', $clasicon_id)
            ->orderBy('created_at', 'desc')->get()
            ->toArray();
        
        $followers = Follower::with('follower')->where('user_id', $clasicon_id)
        ->get();

         


         return Inertia::render('Recommendations/ClasiconView',[

            'clasicones' => $clasicones,
            'followers' => $followers

         ]);

    }

}