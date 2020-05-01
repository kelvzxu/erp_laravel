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
            $table->bigIncrements('id');
            $table->string('purchase_no');
            $table->integer('partner_id');
            $table->date('purchase_date');
            $table->date('due_date');
            $table->bigInteger('total');
            $table->date('updated_at')->nullable();
            $table->bigInteger('payment')->default(0);
            $table->bigInteger('over')->default(0);      
            $table->string('status')->default("UNPAID");
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
