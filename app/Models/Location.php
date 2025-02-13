<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'user_id',
        'box_id',
        'locataire_id',
        'date_de_debut',
        'date_de_fin',
        'montant_paye'
    ];

    protected $casts = [
        'date_de_debut' => 'date',
        'date_de_fin' => 'date',
        'montant_paye' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    public function locataire()
    {
        return $this->belongsTo(Locataire::class);
    }
}
