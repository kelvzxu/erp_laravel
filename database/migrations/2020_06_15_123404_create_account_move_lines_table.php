<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountMoveLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_move_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_move_id');
            $table->string('account_move_name');
            $table->date('date')->nullable();
            $table->string('ref')->nullable();
            $table->string('parent_state')->nullable();
            $table->integer('journal_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('company_currency_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('account_internal_type')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('price_unit')->nullable();
            $table->integer('price_total')->nullable();
            $table->integer('debit')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('balance')->nullable();
            $table->boolean('reconciled')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->string('create_uid')->nullable();
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
        Schema::dropIfExists('account_move_lines');
    }
}
