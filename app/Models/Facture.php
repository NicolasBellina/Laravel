<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'paiement_id',
        'numero_facture',
        'date_facture',
        'montant',
        'pdf_path'
    ];

    protected $casts = [
        'date_facture' => 'date',
        'montant' => 'decimal:2'
        
    ];

    public function paiement()
    {
        return $this->belongsTo(Paiement::class);
    }
} 