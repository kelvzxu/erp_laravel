<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchases_order_id')->unsigned();
            $table->integer('name');
            $table->string('description');
            $table->integer('product_uom');
            $table->integer('product_uom_qty');
            $table->integer('product_uom_category');
            $table->double('qty');
            $table->double('receipt_qty')->nullable()->default(0);
            $table->bigInteger('price');
            $table->bigInteger('price_subtotal');
            $table->bigInteger('taxes');
            $table->bigInteger('price_tax');
            $table->bigInteger('total');
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
        Schema::dropIfExists('purchases_order_products');
    }
}
