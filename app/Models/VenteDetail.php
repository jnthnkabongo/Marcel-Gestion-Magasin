<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteDetail extends Model
{
    protected $fillable = [
        'vente_id', 
        'produit_unite_id', 
        'prix_unitaire', 
        'total'
    ];

    public function vente()
    {
        return $this->belongsTo(Vente::class);
    }

    public function produitUnite()
    {
        return $this->belongsTo(ProduitUnite::class);
    }
}
