<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no')->nullable();
            $table->date('order_date')->nullable();
            $table->date('confirm_date')->nullable();
            $table->integer('vendor')->nullable();
            $table->string('vendor_reference')->nullable();
            $table->bigInteger('sub_total')->nullable();
            $table->bigInteger('discount')->nullable();
            $table->bigInteger('taxes')->nullable();
            $table->bigInteger('grand_total')->nullable();
            $table->boolean('invoice')->default(False);
            $table->string('status')->default("Quotation");
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
        Schema::dropIfExists('purchases_orders');
    }
}
