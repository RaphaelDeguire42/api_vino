<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note_Commentaire extends Model
{
    use HasFactory;

    public function bouteille_note_commentaire() {
        return $this->belongsTo(Bouteille::class, 'id');
    }
    public function bouteille_note_commentaireDansCellier() {
        return $this->belongsTo(Cellier_Bouteille::class, 'id_bouteille');
    }
    public function has_user() {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }
}
