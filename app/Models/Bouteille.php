<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    use HasFactory;

    public function bouteilleHasPays(){
        return $this->hasOne('App\Models\Pays', 'id', 'id_pays');
    }
    
    public function bouteilleHasType(){
        return $this->hasOne('App\Models\Type', 'id', 'id_type');
    }

    public function bouteilleHasFormat(){
        return $this->hasOne('App\Models\Format', 'id', 'id_format');
    }
}
