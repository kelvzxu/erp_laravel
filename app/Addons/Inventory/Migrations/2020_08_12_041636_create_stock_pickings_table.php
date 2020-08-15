<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPickingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_pickings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('origin')->nullable();
            $table->integer('backorder_id')->nullable();
            $table->string('move_type')->nullable();
            $table->string('state')->default('draft');
            $table->DateTime('schedule_date')->nullable();
            $table->DateTime('date_done')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('destination_id')->nullable();
            $table->string('picking_type')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('is_locked')->default(false);
            $table->integer('order_id')->nullable();
            $table->integer('create_uid')->nullable();
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
        Schema::dropIfExists('stock_pickings');
    }
}
