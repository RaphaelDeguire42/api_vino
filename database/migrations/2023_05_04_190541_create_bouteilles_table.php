<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Extension\Table\Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('code_saq');
            $table->string('url_img');
            $table->integer('garde');
            $table->float('prix');
            $table->integer('millesime');
            $table->boolean('actif');
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('types');
            $table->unsignedBigInteger('id_pays');
            $table->foreign('id_pays')->references('id')->on('pays');
            $table->unsignedBigInteger('id_format');
            $table->foreign('id_format')->references('id')->on('formats');
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
        Schema::dropIfExists('bouteilles');
    }
};
