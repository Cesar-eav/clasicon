<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request, $recommendationId)
    {
        Log::info('store method hit with recommendation ID: ' . $recommendationId);

        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'recommendation_id' => $recommendationId,
            'comment' => $request->comment,
        ]);

        $comment = Comment::create([
            'recommendation_id' => $recommendationId,
            'user_id' => auth()->id(),
            'comment' => $validated['comment'],
        ]);
    
        // Devolver el comentario recién creado como respuesta JSON
        return response()->json($comment);    }
}
