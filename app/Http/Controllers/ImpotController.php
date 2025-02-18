<?php

namespace App\Http\Controllers;

use App\Models\Impot;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImpotController extends Controller
{
    public function index()
    {
        $anneeActuelle = date('Y');
        $annees = range($anneeActuelle - 2, $anneeActuelle);
        
        $impots = collect($annees)->map(function($annee) {
            // Calcul du montant total
            $montantTotal = Paiement::whereHas('location', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->whereYear('date_paiement', $annee)
            ->where('est_paye', true)
            ->sum('montant');

            // Création ou mise à jour de l'enregistrement dans la base
            if ($montantTotal > 0) {
                return Impot::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'annee' => $annee,
                    ],
                    [
                        'montant_total' => $montantTotal,
                        'regime' => $montantTotal > 15000 ? 'reel' : 'micro-foncier',
                        'case_declaration' => $montantTotal > 15000 ? '4 BA (2044)' : '4 BE (2042)',
                        'montant_imposable' => $montantTotal > 15000 ? $montantTotal : $montantTotal * 0.7,
                        'regime_reel_obligatoire' => $montantTotal > 15000
                    ]
                );
            }

            // Récupération de l'impôt existant ou création d'un tableau vide
            return Impot::where('user_id', auth()->id())
                        ->where('annee', $annee)
                        ->first() ?? [
                'annee' => $annee,
                'montant_total' => 0,
                'regime_recommande' => 'micro-foncier',
                'montant_imposable' => 0,
                'case_declaration' => '4 BE (2042)'
            ];
        });

        return view('impots.index', compact('impots'));
    }
} 