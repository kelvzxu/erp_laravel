<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_credit', function (Blueprint $table) {
            $table->string('purchase_no');
            $table->integer('partner_id');
            $table->date('purchase_date');
            $table->date('due_date');
            $table->bigInteger('total');
            $table->date('payment_date')->nullable();
            $table->bigInteger('payment');
            $table->bigInteger('over');         
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_credit');
    }
}
