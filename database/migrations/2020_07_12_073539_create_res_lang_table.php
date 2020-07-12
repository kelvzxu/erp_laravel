<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lang_name');
            $table->string('code');
            $table->string('iso_code')->nullable();
            $table->string('url_code')->nullable();
            $table->boolean('active')->default(False)->nullable();
            $table->string('direction');
            $table->string('date_format');
            $table->string('time_format');
            $table->string('week_start');
            $table->string('grouping');
            $table->string('decimal_point');
            $table->string('thousands_sep')->nullable();
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
        Schema::dropIfExists('res_lang');
    }
}
