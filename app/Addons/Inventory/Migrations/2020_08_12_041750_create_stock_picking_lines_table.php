<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockPickingLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_picking_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stock_picking_id');
            $table->integer('product_id');
            $table->string('description');
            $table->integer('qty');
            $table->integer('product_uom');
            $table->integer('done_qty');
            $table->integer('order_line_id')->nullable();
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
        Schema::dropIfExists('stock_picking_lines');
    }
}
