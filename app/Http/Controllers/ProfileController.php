<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Thought;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function myprofile(Request $request): Response
     {
        $user = auth();
        $user_id = auth()->id();
        $mis_clasicones = Recommendation::with('user')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')->get();
        $followers = auth()->user()->followers()->with('follower')->get();

        $thoughts = Thought::where('user_id', $user_id)->get();

         return Inertia::render('Profile/Profile',[
            'user' => $user,
            'mis_clasicones' => $mis_clasicones,
            'followers' => $followers,
            'thoughts' => $thoughts

         ]);

     }


    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validar los datos recibidos
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'about' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // Asegura que sea una imagen válida
        ]);
        $user = $request->user();
        
        // Guardar el nombre
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        // Guardar el email y marcarlo como no verificado si ha cambiado
        if (isset($validated['email']) && $user->email !== $validated['email']) {
            $user->email = $validated['email'];
            $user->email_verified_at = null;
        }

        // Guardar el campo "about"
        if (isset($validated['about'])) {
            $user->about = $validated['about'];
        }

        // Guardar la imagen de perfil
        if ($request->hasFile('profile_picture')) {
            // Eliminar la imagen anterior si existe
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Guardar la nueva imagen
            $user->profile_picture = $request->file('profile_picture')->store("images/profile_picture/$user->id", 'public');
        }



        
        // Guardar los cambios en la base de datos
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
