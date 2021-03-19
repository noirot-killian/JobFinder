<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOffreTable6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->renameColumn('`valideO/N`', 'isValid');
            $table->renameColumn('`archiveO/N`', 'isArchived');
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
            $table->renameColumn('isValid', '`valideO/N`');
            $table->renameColumn('isArchived', '`archiveO/N`');
        });
    }
}
