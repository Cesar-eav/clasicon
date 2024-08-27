<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $recommendationId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
    
        Comment::create([
            'user_id' => auth()->id(),
            'recommendation_id' => $recommendationId,
            'comment' => $request->comment,
        ]);
    
        return redirect()->back()->with('status', 'Comment added successfully!');
    }
    }
