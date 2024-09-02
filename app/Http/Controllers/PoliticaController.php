<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PoliticaController extends Controller
{
    public function privacidad(){
        
        return Inertia::render('Social/PoliticaPrivacidad');
    }

    public function datos(){
        
        return Inertia::render('Social/EliminacionDatos');
    }
}
