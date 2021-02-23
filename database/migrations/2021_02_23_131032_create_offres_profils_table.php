<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres_profils', function (Blueprint $table) {
            $table->unsignedBigInteger('offre_id');
            $table->foreign('offre_id')->references('id')->on('offres');
            $table->unsignedBigInteger('profil_id');
            $table->foreign('profil_id')->references('id')->on('profils');
            $table->primary(['offre_id','profil_id']);
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
        Schema::table('offres_profils', function (Blueprint $table) {
            $table->dropForeign('offre_id');
            $table->dropForeign('profil_id');
        });
        Schema::dropIfExists('offres_profils');
    }
}
