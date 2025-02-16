<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = auth()->user()->locations()->latest()->get();
        return view('locations.index', compact('locations'));
    }

    public function show(Location $location)
    {
            return view('locations.show', compact('location'));
    }
    

    public function edit(Location $location)
    {
            if ($location->user_id !== auth()->id()) {   
            abort(403);
        }
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        if ($location->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'box_id' => 'required|exists:boxes,id',
            'locataire_id' => 'required|exists:locataires,id',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date|after_or_equal:date_de_debut',
            'montant_paye' => 'required|numeric|min:0',
        ]);

        try {
            $location->update($validated);
            return redirect()->route('locations.index')->with('success', 'Location modifiée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la modification de la location')
                ->withInput();
        }
    }

    public function destroy(Location $location)
    {
        if ($location->user_id !== auth()->id()) {
            abort(403);
        }
        
        $location->delete();
        return redirect()->route('locations.index');
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'box_id' => 'required|exists:boxes,id',
            'locataire_id' => 'required|exists:locataires,id',
            'date_de_debut' => 'required|date',
            'date_de_fin' => 'required|date|after_or_equal:date_de_debut',
            'montant_paye' => 'required|numeric|min:0',
        ]);

        try {
            // Ajout automatique de l'user_id
            $validated['user_id'] = auth()->id();
            
            $location = Location::create($validated);
            $location->genererPaiementsMensuels();
            
            return redirect()->route('locations.index')->with('success', 'Location créée avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la création de la location')
                ->withInput();
        }
    }
    

}
