<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()

    {
        // Obtener las notificaciones del usuario autenticado
        return auth()->user()->notifications()->latest()->take(7)->get();
    }



    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead(); // Marca todas las notificaciones como leídas
        return response()->json(['message' => 'Todas las notificaciones marcadas como leídas']);
    }

    public function getUnreadNotifications()
    {
        return auth()->user()->unreadNotifications; // Solo muestra las no leídas
    }
}
