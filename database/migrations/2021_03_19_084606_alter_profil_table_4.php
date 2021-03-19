<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProfilTable4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->renameColumn('`premCoO/N`', 'isFirstCo');
            $table->renameColumn('`isAdminO/N`', 'isAdmin');
            $table->renameColumn('`notifO/N`', 'isNotified');
            $table->renameColumn('`contactO/N`', 'isContactable');
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
            $table->renameColumn('isFirstCo', '`premCoO/N`');
            $table->renameColumn('isAdmin', '`isAdminO/N`');
            $table->renameColumn('isNotified', '`notifO/N`');
            $table->renameColumn('isContactable', '`contactO/N`');
        });
    }
}
