<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'date_paiement',
        'montant',
        'methode_paiement',
        'commentaire',
        'est_paye'
    ];

    protected $casts = [
        'date_paiement' => 'date',
        'est_paye' => 'boolean'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getMethodePaiementFormatteeAttribute()
    {
        $formats = [
            'carte_bancaire' => 'Carte bancaire',
            'virement' => 'Virement bancaire',
            'especes' => 'Espèces',
            'cheque' => 'Chèque',
            'prelevement' => 'Prélèvement'
        ];

        return $formats[$this->methode_paiement] ?? '-';
    }
} 