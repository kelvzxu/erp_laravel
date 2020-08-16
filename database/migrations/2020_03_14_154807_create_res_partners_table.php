<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->integer('company_id')->nullable()->index();
            $table->string('display_name')->nullable();
            $table->string('title')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('ref')->nullable();
            $table->string('lag')->nullable();
            $table->string('tz')->nullable();
            $table->string('user_id')->nullable();
            $table->string('vat')->nullable();
            $table->integer('currency_id')->nullable()->index();
            $table->string('bank_account')->nullable();
            $table->string('website')->nullable();
            $table->string('comment')->nullable();
            $table->bigInteger('credit')->nullable()->default(0);
            $table->bigInteger('debit')->nullable()->default(0);
            $table->bigInteger('warning_stage')->nullable();
            $table->bigInteger('blocking_stage')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('id_pkp')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->integer('state_id')->nullable()->index();
            $table->integer('country_id')->nullable()->index();
            $table->string('partner_latitude')->nullable();
            $table->string('partner_longitude')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('industry_id')->nullable()->index();
            $table->string('additional_info')->nullable();
            $table->string('job_title')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('res_partners');
    }
}
