<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitUnite extends Model
{
    protected $fillable = [
        'produit_id',
        'numero_serie', 
        'quantite',
        'statut'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function venteDetails()
    {
        return $this->hasMany(VenteDetail::class);
    }

    public function garanties()
    {
        return $this->hasMany(Garantie::class);
    }
}
