<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_moves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->string('ref')->nullable();
            $table->string('state')->nullable();
            $table->string('type')->nullable();
            $table->integer('journal_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('amount_untaxed')->default(0)->nullable();
            $table->integer('amount_tax')->default(0)->nullable();
            $table->integer('amount_total')->default(0)->nullable();
            $table->integer('amount_residual')->default(0)->nullable();
            $table->integer('amount_untaxed_signed')->default(0)->nullable();
            $table->integer('amount_tax_signed')->default(0)->nullable();
            $table->integer('amount_total_signed')->default(0)->nullable();
            $table->integer('amount_residual_signed')->default(0)->nullable();
            $table->integer('fiscal_position_id')->default(0)->nullable();
            $table->integer('invoice_id')->default(0)->nullable();
            $table->string('invoice_payment_state')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_date_due')->nullable();
            $table->string('invoice_partner_display_name')->nullable();
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
        Schema::dropIfExists('account_moves');
    }
}
