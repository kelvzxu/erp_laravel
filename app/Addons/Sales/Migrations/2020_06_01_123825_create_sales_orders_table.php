<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->nullable();
            $table->date('order_date')->nullable();
            $table->date('confirm_date')->nullable();
            $table->date('expiration')->nullable();
            $table->integer('customer')->nullable();
            $table->string('customer_reference')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('taxes')->nullable();
            $table->bigInteger('grand_total')->nullable();
            $table->boolean('invoice')->default(False);
            $table->string('state')->default("Quotation");
            $table->boolean('picking')->default(False);
            $table->boolean('picking_validate')->default(False);
            $table->integer('product_warehouse_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('note')->nullable();
            $table->string('is_locked')->default(false);
            $table->string('shipping_policy')->nullable();
            $table->integer('sales')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
}
