<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsDeveloperAndMrpInAccessRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('access_rights', function (Blueprint $table) {
            $table->boolean('manufacture')->nullable()->default(False);
            $table->boolean('developer')->nullable()->default(False);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('access_rights', function (Blueprint $table) {
            $table->dropColumn(['manufacture','developer']);
        });
    }
}
