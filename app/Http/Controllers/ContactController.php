<?php

namespace App\Http\Controllers;

use App\Models\MessageContact;
use App\Models\Terrain;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Page de contact
     */
    public function index()
    {
        $terrain = Terrain::where('actif', true)->first();
        
        return view('contact', compact('terrain'));
    }

    /**
     * Envoyer un message de contact
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'message' => 'required|text|min:10|max:1000',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email n\'est pas valide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min' => 'Le message doit contenir au moins 10 caractères.',
            'message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
        ]);

        MessageContact::create($validated);

        return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}