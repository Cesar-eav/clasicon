<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    public function store(Request $request)
    {
        return $request;
        // $request->validate([
        //     'content' => 'required|string|max:1000',
        //     'parent_id' => 'nullable|exists:thoughts,id', 

        // ]);

        // Guardar el pensamiento
        $thought = Thought::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id, // Si es una respuesta, esto se llena

        ]);

        return response()->json($thought);
    }
}
