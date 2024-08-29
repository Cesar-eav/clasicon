<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller

{

    public function show($recommendationId, $commentId)
{
    // Obtener el comentario con la relación del usuario cargada
    $comment = Comment::with('user')
                ->where('recommendation_id', $recommendationId)
                ->where('id', $commentId)
                ->firstOrFail();

    return response()->json($comment);
}


    public function store(Request $request, $recommendationId)
    {
      
        Log::info('store method hit with recommendation ID: ' . $recommendationId);

        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        $comment = Comment::create([
            'recommendation_id' => $recommendationId,
            'user_id' => auth()->id(),
            'comment' => $validated['comment'],
        ]);
    
        // Devolver el comentario recién creado como respuesta JSON
        return response()->json($comment);    }
}
