<?php

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
        Schema::create('cellier__bouteilles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bouteille');
            $table->integer('id_cellier');
            $table->string('nom')->nullable();
            $table->integer('quantite');
            $table->dateTime('date_achat');
            $table->integer('garde');
            $table->integer('millesime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cellier__bouteilles');
    }
};
