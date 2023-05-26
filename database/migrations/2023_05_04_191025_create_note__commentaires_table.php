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
        Schema::create('note__commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('note');
            $table->text('commentaire');
            $table->timestamps();
            $table->unsignedBigInteger('id_bouteille');
            $table->foreign('id_bouteille')->references('id')->on('bouteilles');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note__commentaires');
    }
};
