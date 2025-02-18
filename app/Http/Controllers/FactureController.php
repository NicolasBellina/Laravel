<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Facture;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FactureController extends Controller
{
    public function generate(Paiement $paiement)
    {
        if (!$paiement->est_paye) {
            return redirect()->back()->with('error', 'Impossible de générer une facture pour un paiement non effectué');
        }

        if ($paiement->facture) {
            return Storage::download($paiement->facture->pdf_path);
        }

        $numero_facture = 'F' . date('Y') . '-' . str_pad($paiement->id, 5, '0', STR_PAD_LEFT);
        
        $data = [
            'paiement' => $paiement,
            'location' => $paiement->location,
            'locataire' => $paiement->location->locataire,
            'box' => $paiement->location->box,
            'numero_facture' => $numero_facture,
            'date_facture' => now()->format('d/m/Y'),
        ];

        $pdf = Pdf::loadView('factures.template', $data);
        
        $path = 'factures/' . $data['numero_facture'] . '.pdf';
        Storage::put($path, $pdf->output());

        Facture::create([
            'paiement_id' => $paiement->id,
            'numero_facture' => $numero_facture,
            'date_facture' => now(),
            'montant' => $paiement->montant,
            'pdf_path' => $path
        ]);

        return Storage::download($path);
    }
} 