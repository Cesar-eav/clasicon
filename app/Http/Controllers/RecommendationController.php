<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the recommendations.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Obtener las recomendaciones del usuario autenticado
        $recommendations = Recommendation::where('user_id', auth()->id())->get();

        return Inertia::render('Recommendations/Index', [
            'recommendations' => $recommendations,
        ]);
    }

    /**
     * Show the form for creating a new recommendation.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Recommendations/Create');
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
            'description' => 'nullable|string',
            'category' => 'required|string|in:book,movie,game,series',
        ]);

        // Crear la nueva recomendación
        Recommendation::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        // Redirigir de vuelta a la lista de recomendaciones
        return redirect()->route('recommendations.index')->with('success', 'Recomendación creada con éxito.');
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
        $this->authorize('update', $recommendation);

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
        $this->authorize('update', $recommendation);

        // Validar la entrada del usuario
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|in:book,movie,game,series',
        ]);

        // Actualizar la recomendación
        $recommendation->update($request->only('title', 'description', 'category'));

        // Redirigir de vuelta a la lista de recomendaciones
        return redirect()->route('recommendations.index')->with('success', 'Recomendación actualizada con éxito.');
    }

    /**
     * Remove the specified recommendation from storage.
     *
     * @param  \App\Models\Recommendation  $recommendation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Recommendation $recommendation)
    {
        // Asegurarse de que el usuario autenticado sea el propietario de la recomendación
        $this->authorize('delete', $recommendation);

        // Eliminar la recomendación
        $recommendation->delete();

        // Redirigir de vuelta a la lista de recomendaciones
        return redirect()->route('recommendations.index')->with('success', 'Recomendación eliminada con éxito.');
    }
}
