<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellier extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user'
    ];

    public function cellierHasCouleur(){
        return $this->hasOne('App\Models\Pastille_Couleur', 'id', 'id_couleur');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bouteilles() {
        return $this->hasmany(Bouteille::class);
    }

    public function couleur(){
        return $this->belongsTo(Pastille_couleur::class, 'id_couleur');
    }
}
