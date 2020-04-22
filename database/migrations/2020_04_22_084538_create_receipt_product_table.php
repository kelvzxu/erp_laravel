<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('receipt_no');
            $table->string('purchase_no');
            $table->date('receipt_date');
            $table->boolean('validate')->default(False);
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
        Schema::dropIfExists('receipt_products');
    }
}
