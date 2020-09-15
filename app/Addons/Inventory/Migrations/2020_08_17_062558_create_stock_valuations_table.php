<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockValuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_valuations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable()->default(1);
            $table->integer('product_id')->nullable();
            $table->double('quantity')->default(0);
            $table->integer('unit_cost')->default(0);
            $table->integer('value')->default(0);
            $table->integer('remaining_qty')->default(0);
            $table->integer('remaining_value')->default(0);
            $table->text('description')->nullable();
            $table->integer('stock_move_id')->nullable();
            $table->integer('account_move_id')->nullable();
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
        Schema::dropIfExists('stock_valuations');
    }
}
