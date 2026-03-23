<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriqueAction extends Model
{
    protected $fillable = [
        'user_id', 
        'action', 
        'type',
        'description', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
