<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;
    protected $fillable = [
        'format'
    ];

    public function bouteille()
    {
        return $this->hasOne(Bouteille::class, 'id_format');
    }
}
