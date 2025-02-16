<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index(Location $location)
    {
        $paiements = $location->paiements()->orderBy('date_paiement')->get();
        return view('paiements.index', compact('location', 'paiements'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $validated = $request->validate([
            'est_paye' => 'boolean|nullable',
            'date_paiement' => 'required|date',
            'methode_paiement' => 'nullable|string|in:carte_bancaire,virement,especes,cheque,prelevement',
            'commentaire' => 'nullable|string'
        ]);

        // Si le mode de paiement est défini, marquer comme payé
        if (!empty($validated['methode_paiement'])) {
            $validated['est_paye'] = true;
        }

        $paiement->update($validated);
        return redirect()->back()->with('success', 'Paiement mis à jour avec succès');
    }
} 