<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Guardar el pensamiento
        $thought = Thought::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return response()->json($thought);
    }
}
