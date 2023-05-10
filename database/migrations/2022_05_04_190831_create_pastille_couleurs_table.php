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
            'black' => '#000000',
            'white' => '#ffffff',
            'red' => '#ff0000',
            'green' => '#00ff00',
            'blue' => '#0000ff',
            'yellow' => '#ffff00',
            'magenta' => '#ff00ff',
            'cyan' => '#00ffff',
            'maroon' => '#800000',
            'olive' => '#008000',
            'navy' => '#000080',
            'teal' => '#808000',
            'purple' => '#800080',
            'dark_cyan' => '#008080',
            'grey' => '#808080'
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
