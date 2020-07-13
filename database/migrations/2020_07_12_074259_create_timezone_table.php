<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimezoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezone', function (Blueprint $table) {
            $table->string('country_code');
            $table->string('timezone',200)->unique();
            $table->decimal('gmt_offset');
            $table->decimal('dst_offset');
            $table->decimal('raw_offset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timezone');
    }
}
