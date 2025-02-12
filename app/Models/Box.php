<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity'
    ];
}
