<?php

namespace App\Http\Controllers;

use App\Models\Locataire;
use Illuminate\Http\Request;

class LocataireController extends Controller
{
    public function index()
    {
        $locataires = auth()->user()->locataires()->latest()->get();
        return view('locataires.index', compact('locataires'));
    }

    public function show(Locataire $locataire)
    {
        return view('locataires.show', compact('locataire'));
    }
    

    public function edit(Locataire $locataire)
    {
        if ($locataire->user_id !== auth()->id()) {   
            abort(403);
        }
        return view('locataires.edit', compact('locataire'));
    }

    public function update(Request $request, Locataire $locataire)
    {
        if ($locataire->user_id !== auth()->id()) {
            abort(403);
        }

        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'compte_bancaire' => 'required|string|max:255',
        ]);

        try {
            $locataire->update($validated);
            return redirect()->route('locataire.index')->with('success', 'Locataire modifié avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification du locataire')->withInput();
        }
    }

    public function destroy(Locataire $locataire)
    {
        if ($locataire->user_id !== auth()->id()) {
            abort(403);
        }
        
        $locataire->delete();
        return redirect()->route('locataire.index');
    }

    public function create()
    {
        return view('locataires.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'compte_bancaire' => 'required|string|max:255',
        ]);

        try {
            $locataire = auth()->user()->locataires()->create($validated);
            return redirect()->route('locataire.index')->with('success', 'Locataire créé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du locataire')->withInput();
        }
    }
    

}
