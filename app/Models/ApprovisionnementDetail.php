<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovisionnementDetail extends Model
{
    protected $fillable = [
        'approvisionnement_id', 
        'produit_id', 
        'quantite', 
        'prix_achat'
    ];

    public function approvisionnement()
    {
        return $this->belongsTo(Approvisionnement::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
