<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom_client', 
        'telephone', 
        'email', 
        'adresse'];

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function garanties()
    {
        return $this->hasMany(Garantie::class);
    }
}
