<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        'client_id',
        'user_id', 
        'nom_client',
        'date_vente', 
        'total', 
        'statut'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venteDetails()
    {
        return $this->hasMany(VenteDetail::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
