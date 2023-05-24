<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cellier_Bouteille extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bouteille',
        'id_cellier',
        'id_pays',
        'nom',
        'url_img',
        'quantite',
        'date_achat',
        'garde',
        'millesime',
    ];


    public function bouteillesDansCellier_bouteilles() {
        return $this->hasOne(Bouteille::class, 'id', 'id_bouteille');
    }

    //TODO RELATION POUR AFFICHER PAYS


    public function celliersDansCellier_bouteilles() {
        return $this->belongsTo(Cellier::class);
    }
}
