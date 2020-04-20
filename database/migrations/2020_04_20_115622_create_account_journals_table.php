<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->nullable();
            $table->boolean('active')->nullable();
            $table->string('type')->nullable();
            $table->integer('default_credit_account_id')->index()->nullable();
            $table->integer('default_debit_account_id')->index()->nullable();
            $table->boolean('restrict_mode_hash_table')->nullable();
            $table->integer('sequence_id')->index()->nullable();
            $table->integer('refund_sequence_id')->index()->nullable();
            $table->string('invoice_reference_type')->nullable();
            $table->string('invoice_reference_model')->nullable();
            $table->integer('currency_id')->index()->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->boolean('refund_sequence')->nullable();
            $table->boolean('at_least_one_inbound')->nullable();
            $table->boolean('at_least_one_outbound')->nullable();
            $table->integer('profit_account_id')->index()->nullable();
            $table->integer('loss_account_id')->index()->nullable();
            $table->integer('bank_account_id')->index()->nullable();
            $table->string('bank_statements_source')->nullable();
            $table->string('post_at')->nullable();
            $table->integer('alias_id')->index()->nullable();
            $table->integer('secure_sequence_id')->index()->nullable();
            $table->integer('show_on_dashboard')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_journals');
    }
}
