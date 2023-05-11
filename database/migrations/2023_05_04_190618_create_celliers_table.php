<?php

use App\Models\Cellier;
use App\Models\User;
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
        Schema::create('celliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nom')->default('Mon cellier');
            $table->unsignedBigInteger('id_couleur')->default(1);
            $table->foreign('id_couleur')->references('id')->on('pastille_couleurs');
            $table->timestamps();
        });

        $users = User::all();
        foreach ($users as $user) {
            Cellier::firstOrCreate(
                ['id_user' => $user->id],
                ['nom' => 'Mon premier Cellier', 'id_couleur' => 1]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('celliers');
    }
};
