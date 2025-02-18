<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratTemplate extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'contenu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateContrat($location)
    {
        $contenu = $this->contenu;
        
        $variables = [
            '@{{ nom_locataire }}' => $location->locataire->nom,
            '@{{ tel_locataire }}' => $location->locataire->tel,
            '@{{ mail_locataire }}' => $location->locataire->mail,
            '@{{ adresse_locataire }}' => $location->locataire->adresse,
            '@{{ box_name }}' => $location->box->name,
            '@{{ date_debut }}' => $location->date_de_debut->format('d/m/Y'),
            '@{{ date_fin }}' => $location->date_de_fin->format('d/m/Y'),
            '@{{ montant }}' => $location->montant_paye,
        ];

        return str_replace(array_keys($variables), array_values($variables), $contenu);
    }
} 