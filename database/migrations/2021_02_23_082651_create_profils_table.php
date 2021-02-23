<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('pseudo');
            $table->string('mdp');
            $table->string('ville');
            $table->string('CP');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('tel',12);
            $table->string('CV');
            $table->boolean('premCoO/N')->default('0');
            $table->boolean('isAdminO/N')->default('0');
            $table->boolean('notifO/N')->default('0');
            $table->boolean('contactO/N')->default('0');
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
        Schema::dropIfExists('profils');
    }
}
