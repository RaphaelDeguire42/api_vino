<?php

use App\Models\Pastille_couleur;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastille_couleurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('hex_value');
            $table->timestamps();
        });

        $colors = array(
            'noir' => '#000000',
            'gris' => '#808080',
            'blanc' => '#ffffff',
            'rouge' => '#ff0000',
            'vert' => '#00ff00',
            'bleu' => '#0000ff',
            'jaune' => '#ffff00',
            'magenta' => '#ff00ff',
            'cyan' => '#00ffff',
            'maron' => '#800000',
            'olive' => '#008000',
            'bleu marine' => '#000080',
            'mauve' => '#800080',
            'cyan foncé' => '#008080',
        );

        foreach ($colors as $color => $hex) {
            $couleur = new Pastille_couleur();
            $couleur->nom = $color;
            $couleur->hex_value = $hex;
            $couleur->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastille_couleurs');
    }
};
