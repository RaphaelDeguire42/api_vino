<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erreur extends Model
{
    use HasFactory;
    protected $fillable = [
        'erreur'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
