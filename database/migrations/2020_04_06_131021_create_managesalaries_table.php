<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagesalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managesalaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payslip_no');
            $table->integer('employee_id');
            $table->string('designation_type');
            $table->string('salary');
            $table->string('date_from');
            $table->string('date_to');
            $table->string('working_days');
            $table->string('leave_days');
            $table->string('tax');
            $table->string('gross_salary');
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
        Schema::dropIfExists('managesalaries');
    }
}
