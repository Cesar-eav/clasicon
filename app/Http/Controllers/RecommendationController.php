<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use App\Models\GptRecommendation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class RecommendationController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the recommendations.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Obtener las recomendaciones del usuario autenticado
        $recommendations = Recommendation::where('user_id', auth()->id())
        ->orderBy('created_at','desc')
        ->get();
        $userId = auth()->id();

        return Inertia::render('Recommendations/Index', [
            'recommendations' => $recommendations,
            'userId' => $userId
        ]);
    }

    public function sugerencia()
    {
        

        return Inertia::render('Recommendations/Sugerencia');
    }


  
    public function create()
    {
        $userId = 99;
        return Inertia::render('Recommendations/Create', [
            'userId' => $userId
        ]);
    }

    public function explore()
    {
        // Obtener todas las recomendaciones de otros usuarios, excluyendo las del usuario autenticado
        $recommendations = Recommendation::with('user')
            ->where('user_id', '!=', auth()->id())
            ->latest()
            ->get();

        // Retornar la vista con las recomendaciones obtenidas
        return Inertia::render('Recommendations/Explore', [
            'recommendations' => $recommendations,
        ]);
    }



    /**
     * Store a newly created recommendation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'title' => 'required|string|max:255',
            'ciudad' => 'string|max:255',
            'autor' => 'nullable|string|max:255',
            'enlace' => 'nullable|string|max:255',
            // 'lat' => 'nullable|numeric|max:10',
            // 'lng' => 'nullable|numeric|max:10',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,webp,jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            'tags' => 'nullable|string'
        ]);

        $user_id = 99;


        // Manejar la subida de la imagen si existe
        $imagePath = null; 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("images/$request->category/$user_id", 'public');
        }

        // Crear la nueva recomendación
        Recommendation::create([
            'user_id' => 99,
            'title' => $request->title,
            'ciudad' => $request->ciudad,
            'autor' => $request->autor,
            'enlace' => $request->enlace,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath, // Guardar la ruta de la imagen
            'tags' => $request->tags ? json_encode(explode(',', $request->tags)) : null // Guardar las etiquetas como JSON
        ]);

        // Redirigir de vuelta a la lista de recomendaciones
        //return redirect()->route('welcome')->with('success', 'Recomendación creada con éxito.');
    }


    /**
     * Show the form for editing the specified recommendation.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Inertia\Response
     */
    public function edit(Recommendation $recommendation)
    {
        // Asegurarse de que el usuario autenticado sea el propietario de la recomendación
        // $this->authorize('update', $recommendation);


        return Inertia::render('Recommendations/Edit', [
            'recommendation' => $recommendation,
        ]);
    }

    /**
     * Update the specified recommendation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\RedirectResponse
     */



    public function update(Request $request, Recommendation $recommendation)
    {
        // Asegurarse de que el usuario autenticado sea el propietario de la recomendación
        //$this->authorize('update', $recommendation);

        // Validar la entrada del usuario

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validar que la imagen sea opcional, de tipo imagen y con tamaño máximo de 2MB
            'autor' =>'nullable|string',
            'enlace' =>'nullable|string'
        ]);

        // Si hay una nueva imagen, procesarla
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($recommendation->image) {
                Storage::delete('public/images/' . $recommendation->image);
            }
            $user_id = auth()->id();

            // Almacenar la nueva imagen
            $imagePath = $request->file('image')->store("images/$request->category/$user_id", 'public');
            // $recommendation->image = $imagePath;
            // return $recommendation;
        }

    // Asignar los campos individualmente
    $recommendation->title = $request->input('title');
    $recommendation->description = $request->input('description');
    $recommendation->category = $request->input('category');
    $recommendation->lat = $request->input('lat');
    $recommendation->lng = $request->input('lng');
    $recommendation->autor = $request->input('autor');
    $recommendation->enlace = $request->input('enlace');
    
    // Solo si se ha cargado una nueva imagen, actualizar la columna 'image'
    if ($request->hasFile('image')) {
        $recommendation->image = $imagePath;
    }

    // Guardar los cambios en la base de datos
    $recommendation->save();

        // Redirigir de vuelta a la lista de recomendaciones
        return redirect()->route('recommendations.index')->with('success', 'Recomendación actualizada con éxito.');
    }




    /**
     * Remove the specified recommendation from storage.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Buscar la recomendación por ID
        $recommendation = Recommendation::find($id);

        // Verificar si la recomendación existe
        if (!$recommendation) {
            return redirect()->back()->withErrors(['message' => 'La recomendación no fue encontrada.']);
        }

        // Verificar si el usuario autenticado es el dueño de la recomendación
        if ($recommendation->user_id !== auth()->id()) {
            return redirect()->back()->withErrors(['message' => 'No tienes permiso para eliminar esta recomendación.']);
        }

    
        if ($recommendation->image) {
            Storage::delete('public/' . $recommendation->image);
        }

        
        $recommendation->delete();

        
    }


    public function getRandomRecommendations()
    {
        $books = GptRecommendation::where('category', 'book')->inRandomOrder()->take(5)->get();
        $movies = GptRecommendation::where('category', 'movie')->inRandomOrder()->take(5)->get();
        $games = GptRecommendation::where('category', 'game')->inRandomOrder()->take(5)->get();
        $series = GptRecommendation::where('category', 'series')->inRandomOrder()->take(5)->get();

        return response()->json([
            'books' => $books,
            'movies' => $movies,
            'games' => $games,
            'series' => $series,
        ]);
    }


    public function getNaturalezaRecommendations()
    {
        $recommendations = Recommendation::where('category', 'nature')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Naturaleza', [
            'recommendations' => $recommendations,
        ]);
    }

    public function getMonumentosRecommendations()
    {
        $recommendations = Recommendation::where('category', 'monument')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Monumentos', [
            'recommendations' => $recommendations,
        ]);
    }

    public function getMuseosRecommendations()
    {
        $recommendations = Recommendation::where('category', 'museum')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Museos', [
            'recommendations' => $recommendations,
        ]);
    }


    public function getStreetartRecommendations()
    {
        $recommendations = Recommendation::where('category', 'streetart')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Museos', [
            'recommendations' => $recommendations,
        ]);
    }
    
    public function getCulturaRecommendations()
    {
        $recommendations = Recommendation::where('category', 'culture')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Cultura', [
            'recommendations' => $recommendations,
        ]);
    }
    
    public function getArquitecturaRecommendations()
    {
        $recommendations = Recommendation::where('category', 'architecture')
            ->latest()
            ->get();
        
        return Inertia::render('Recommendations/Arquitectura', [
            'recommendations' => $recommendations,
        ]);
    }
}
