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

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'id_format');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type');
    }

    public function noteCommentaire() {
        return $this->hasmany(Note_Commentaire::class);
    }

    public function celliersDansCellier_bouteilles() {
        return $this->belongsTo(Cellier::class);
    }
}
