<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Impot extends Model
{
    protected $fillable = [
        'user_id',
        'annee',
        'montant_total',
        'regime',
        'case_declaration',
        'montant_imposable',
        'regime_reel_obligatoire'
    ];

    protected $casts = [
        'montant_total' => 'decimal:2',
        'montant_imposable' => 'decimal:2',
        'regime_reel_obligatoire' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($impot) {
            $impot->regime_reel_obligatoire = $impot->montant_total > 15000;
            $impot->regime = $impot->regime_reel_obligatoire ? 'reel' : 'micro-foncier';
            $impot->case_declaration = $impot->regime === 'micro-foncier' ? '4 BE (2042)' : '4 BA (2044)';
            $impot->montant_imposable = $impot->regime === 'micro-foncier' 
                ? $impot->montant_total * 0.7 
                : $impot->montant_total;
        });
    }
}