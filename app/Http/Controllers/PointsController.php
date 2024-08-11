<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PointsController extends Controller
{
    public function index()
    {
        $points = auth()->user()->points;

        return Inertia::render('Profile/Points', [
            'points' => $points,
        ]);
    }
}
