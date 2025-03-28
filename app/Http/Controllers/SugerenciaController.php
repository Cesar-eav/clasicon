<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;


use App\Models\Sugerencia;

use Illuminate\Http\Request;

class SugerenciaController extends Controller
{
    public function store(Request $request)
    {
        //return $request;
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'detailed_title' => 'required|string',
            'detailed_ciudad' => 'required|string',
            'detailed_lat' => 'required|string',
            'detailed_lng' => 'required|string',
            'detailed_enlace' => 'nullable|string',
            'detailed_autor' => 'nullable|string',
            'detailed_description' => 'required|string',
            'detailed_category' => 'required|string',
            'detailed_image' => 'nullable|image',
            'detailed_tags' => 'nullable|string',
        ]);

        // Guardar los datos en la base de datos
        $sugerencia = new Sugerencia();
        $sugerencia->title = $validatedData['detailed_title'];
        $sugerencia->ciudad = $validatedData['detailed_ciudad'];
        $sugerencia->lat = $validatedData['detailed_lat'];
        $sugerencia->lng = $validatedData['detailed_lng'];
        $sugerencia->enlace = $validatedData['detailed_enlace'];
        $sugerencia->autor = $validatedData['detailed_autor'];
        $sugerencia->description = $validatedData['detailed_description'];
        $sugerencia->category = $validatedData['detailed_category'];
        $sugerencia->tags = $validatedData['detailed_tags'];

        // Guardar la imagen si se ha subido
        if ($request->hasFile('detailed_image')) {
            $image = $request->file('detailed_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sugerencias'), $imageName);
            $sugerencia->image = 'images/sugerencias/' . $imageName;
        }

        $sugerencia->save();

        // Retornar una respuesta exitosa
        return Redirect::route('welcome');
    }

    // FORMULARIO RAPIDO
    public function storeQuick(Request $request)
    {
        //return $request;
        
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'quick_title' => 'required|string',
            'quick_description' => 'required|string',
            'quick_city' => 'required|string',
            'quick_image' => 'nullable|image',
        ]);

        // Guardar los datos en la base de datos
        $sugerencia = new Sugerencia();
        $sugerencia->title = $validatedData['quick_title'];
        $sugerencia->ciudad = $validatedData['quick_city'];
        $sugerencia->description = $validatedData['quick_description'];

        // Guardar la imagen si se ha subido
        if ($request->hasFile('quick_image')) {
            $image = $request->file('quick_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sugerencias'), $imageName);
            $sugerencia->image = 'images/sugerencias/' . $imageName;
        }

        $sugerencia->save();

        // Retornar una respuesta exitosa
        return Redirect::route('welcome');
    }
}