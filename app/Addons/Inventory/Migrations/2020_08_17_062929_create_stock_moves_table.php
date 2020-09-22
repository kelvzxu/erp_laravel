<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable()->default(1);
            $table->integer('product_id')->nullable();
            $table->double('quantity')->default(0);
            $table->integer('product_uom')->default(0);
            $table->integer('location_id')->default(0);
            $table->integer('location_destination')->default(0);
            $table->string('location_name')->nullable();
            $table->string('location_destination_name')->nullable();
            $table->integer('partner_id')->default(0);
            $table->string('state')->default('draft');
            $table->string('type');
            $table->string('reference')->nullable();
            $table->integer('order_line_id')->nullable();
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
        Schema::dropIfExists('stock_moves');
    }
}
