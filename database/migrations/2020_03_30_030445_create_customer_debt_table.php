<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDebtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_debt', function (Blueprint $table) {
            $table->string('invoice_no');
            $table->integer('customer_id');
            $table->date('invoice_date');
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
        Schema::dropIfExists('customer_debt');
    }
}
