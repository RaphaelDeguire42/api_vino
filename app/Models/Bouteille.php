<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'nom',
        'code_saq',
        'url_saq',
        'url_img',
        'prix',
        'id_format',
        'id_pays',
        'id_type',
    ];

    public function bouteilleHasPays(){
        return $this->hasOne('App\Models\Pays', 'id', 'id_pays');
    }

    public function bouteilleHasType(){
        return $this->hasOne('App\Models\Type', 'id', 'id_type');
    }

    public function bouteilleHasFormat(){
        return $this->hasOne('App\Models\Format', 'id', 'id_format');
    }


    public function bouteillesDansCellierB() {
        return $this->belongsTo(Cellier_Bouteilles::class);
    }

    public function noteCommentaire() {
        return $this->hasmany(Note_Commentaire::class, 'id');
    }
    
    public function type()
    {
        return $this->belongsTo(Type::class, 'id_type');
    }

    public function format()
    {
        return $this->belongsTo(Format::class, 'id_format');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'id_pays');
    }
}
