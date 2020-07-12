<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('payment_reference')->nullable();
            $table->string('move_name')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('destination_journal_id')->nullable();
            $table->string('state')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('partner_type')->nullable();
            $table->string('partner_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('currency_id')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('communication')->nullable();
            $table->integer('journal_id')->nullable();
            $table->string('payment_difference_handling')->nullable();
            $table->string('check_amount_in_words')->nullable();
            $table->string('check_number')->nullable();
            $table->string('bank_reference')->nullable();
            $table->string('cheque_reference')->nullable();
            $table->date('effective_date')->nullable();
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
        Schema::dropIfExists('account_payments');
    }
}
