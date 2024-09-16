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

    public function showSearchResults(Request $request)
{
    $query = $request->input('query');

    // Realiza la búsqueda de las recomendaciones
    $results = Recommendation::where('title', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhereJsonContains('tags', $query)
                ->paginate(10); // Paginar los resultados

    return inertia('Recommendations/SearchResults', [
        'query' => $query,
        'results' => $results
    ]);
}


    public function clasicon($clasicon_id){

        
     
        $clasicon = Recommendation::with('user')
            ->where('id', $clasicon_id)
            ->orderBy('created_at', 'desc')->get()
            ->toArray();
        
        $followers = Follower::with('follower')->where('user_id', $clasicon_id)
        ->first();

         


         return Inertia::render('Recommendations/ClasiconView',[

            'clasicon' => $clasicon,
            'followers' => $followers

         ]);

    }

}
