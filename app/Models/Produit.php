<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom', 
        'categorie_id', 
        'marque_id', 
        'modele', 
        'description', 
        'prix_achat', 
        'prix_vente', 
        'stock_min'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function produitUnites()
    {
        return $this->hasMany(ProduitUnite::class);
    }

    public function approvisionnementDetails()
    {
        return $this->hasMany(ApprovisionnementDetail::class);
    }
}
