<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locataire extends Model
{
    protected $fillable = [
        'nom',
        'tel',
        'mail',
        'adresse',
        'compte_bancaire',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
