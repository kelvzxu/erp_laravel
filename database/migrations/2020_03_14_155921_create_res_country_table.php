<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_country', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country_name')->nullable();
            $table->string('code')->nullable();
            $table->string('address_format')->nullable();
            $table->string('address_view_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('phone_code')->nullable();
            $table->string('name_position')->nullable();
            $table->string('vat_label')->nullable();
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
        Schema::dropIfExists('res_country');
    }
}
