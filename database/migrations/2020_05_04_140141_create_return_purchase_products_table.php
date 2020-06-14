<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnPurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchase_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('return_purchase_id')->unsigned();
            $table->integer('name');
            $table->integer('price');
            $table->integer('qty');
            $table->integer('return_qty');
            $table->integer('total');
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
        Schema::dropIfExists('return_purchase_products');
    }
}
