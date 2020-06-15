<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsAccountingInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('income_account')->nullable();
            $table->integer('expense_account')->nullable();
            $table->integer('stock_input_account')->nullable();
            $table->integer('stock_output_account')->nullable();
            $table->integer('stock_valuation_account')->nullable();
            $table->integer('stock_journal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
