<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_profils', function (Blueprint $table) {
            $table->unsignedBigInteger('message_id');
            $table->foreign('message_id')->references('id')->on('messages');
            $table->unsignedBigInteger('profil_id');
            $table->foreign('profil_id')->references('id')->on('profils');
            $table->primary(['message_id','profil_id']);
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
        Schema::table('profils', function (Blueprint $table) {
            $table->dropForeign('message_id');
            $table->dropForeign('profil_id');
        });
        Schema::dropIfExists('messages_profils');
    }
}
