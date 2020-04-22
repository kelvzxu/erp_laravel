<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_no');
            $table->date('purchase_date');
            $table->date('due_date')->nullable();
            $table->string('title')->nullable();
            $table->integer('client');
            $table->string('client_address')->nullable();
            $table->bigInteger('sub_total');
            $table->bigInteger('discount');
            $table->bigInteger('grand_total');
            $table->boolean('approved')->default(False);
            $table->string('status')->default("Pending");
            $table->boolean('receipt')->default(False);
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
        Schema::drop('purchases');
    }
}
