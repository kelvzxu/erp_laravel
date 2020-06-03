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
            $table->string('order_no');
            $table->date('order_date');
            $table->integer('vendor');
            $table->string('vendor_reference')->nullable();
            $table->bigInteger('sub_total');
            $table->bigInteger('discount');
            $table->bigInteger('taxes');
            $table->bigInteger('grand_total');
            $table->boolean('invoice')->default(False);
            $table->string('status')->default("RFQ");
            $table->boolean('receipt')->default(False);
            $table->boolean('receipt_validate')->default(False);
            $table->integer('merchandise')->nullable();
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
