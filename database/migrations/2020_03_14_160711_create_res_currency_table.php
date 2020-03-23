<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_currency', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency_name')->nullable();
            $table->string('symbol')->nullable();
            $table->double('rounding')->nullable();
            $table->integer('decimal_places')->nullable();
            $table->boolean('active')->nullable();
            $table->string('position')->nullable();
            $table->string('currency_unit_label')->nullable();
            $table->string('currency_subunit_label')->nullable();
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
        Schema::dropIfExists('res_currency');
    }
}
