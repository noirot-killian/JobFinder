<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('description');
            $table->string('durée');
            $table->string('ville');
            $table->string('entreprise');
            $table->string('contact');
            $table->string('PDF');
            $table->boolean('valideO/N')->default('0');
            $table->boolean('archiveO/N')->default('0');
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
        Schema::dropIfExists('offres');
    }
}
