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
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->float('rounding');
            $table->integer('decimal_places');
            $table->boolean('active');
            $table->enum('position',['after','before']);
            $table->string('currency_unit_label');
            $table->string('currency_subunit_label');
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
