<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  
    public function index()
    {
        // Récupérer le terrain (on suppose qu'il y en a un seul)
        $terrain = Terrain::where('actif', true)->first();
        
        return view('home', compact('terrain'));
    }

    public function aPropos()
    {
        $terrain = Terrain::where('actif', true)->first();
        
        return view('a-propos', compact('terrain'));
    }
}