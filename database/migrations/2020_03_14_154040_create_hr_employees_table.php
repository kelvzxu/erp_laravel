<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_name')->nullable();
            $table->integer('user_id')->nullable()->index();
            $table->boolean('active')->nullable();
            $table->integer('country_id')->index()->nullable();
            $table->string('gender')->nullable();
            $table->string('marital')->nullable();
            $table->string('spouse_complete_name')->nullable();
            $table->date('spouse_birthdate')->nullable();
            $table->string('children')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->integer('country_of_birth')->nullable()->index();
            $table->date('birthday')->nullable();
            $table->string('ssnid')->nullable();
            $table->string('identification_id')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('bank_account_id')->nullable();
            $table->string('permit_no')->nullable();
            $table->string('visa_no')->nullable();
            $table->date('visa_expire')->nullable();
            $table->longText('additional_note')->nullable();
            $table->string('certificate')->nullable();
            $table->string('study_field')->nullable();
            $table->string('study_school')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->longText('notes')->nullable();
            $table->string('barcode',200)->nullable()->unique();
            $table->string('pin')->nullable();
            $table->string('departure_reason')->nullable();
            $table->string('departure_description')->nullable();
            $table->integer('department_id')->index()->nullable();
            $table->integer('job_id')->index()->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->integer('state_id')->nullable()->index();
            $table->string('work_phone')->nullable();
            $table->string('mobile_phonee')->nullable();
            $table->string('work_email')->nullable();
            $table->string('work_location')->nullable();
            $table->string('photo')->nullable();
            $table->string('salary')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('coach_id')->nullable();
            $table->integer('currency_id')->nullable();
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
        Schema::dropIfExists('hr_employees');
    }
}
