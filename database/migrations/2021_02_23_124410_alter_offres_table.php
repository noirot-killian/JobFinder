<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropForeign('categorie_id');
            $table->dropColumn('categorie_id');
            $table->dropForeign('type_id');
            $table->dropColumn('type_id');
        });
    }
}
