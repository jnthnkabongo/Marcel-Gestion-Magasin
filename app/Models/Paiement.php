<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'vente_id', 
        'montant', 
        'methode', 
        'date'
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }
}
