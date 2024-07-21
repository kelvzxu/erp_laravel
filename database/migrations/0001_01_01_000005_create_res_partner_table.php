<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('res_partner_title', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shortcut');
            $table->timestamps();
        });

        schema::create('res_partner_industry', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->timestamps();
        });
        
        Schema::create('res_partner', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('display_name')->nullable();
            $table->unsignedBigInteger('title_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('tz_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->enum('type', ['contact', 'invoice','delivery','other'])->default('contact');
            $table->string('vat')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('website')->nullable();
            $table->string('comment')->nullable();
            $table->bigInteger('credit')->nullable()->default(0);
            $table->bigInteger('debit')->nullable()->default(0);
            $table->bigInteger('warning_stage')->nullable();
            $table->bigInteger('blocking_stage')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('id_pkp')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->string('partner_latitude')->nullable();
            $table->string('partner_longitude')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('job_title')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('title_id')->references('id')->on('res_partner_title');
            $table->foreign('industry_id')->references('id')->on('res_partner_industry');
            $table->foreign('parent_id')->references('id')->on('res_partner');
            $table->foreign('currency_id')->references('id')->on('res_currency');
            $table->foreign('state_id')->references('id')->on('res_country_state');
            $table->foreign('country_id')->references('id')->on('res_country');
            
        });

        schema::create('res_partner_bank', function (Blueprint $table) {
            $table->id();
            $table->string('acc_number');
            $table->string('acc_holder_name')->nullable();
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('res_partner');
            $table->foreign('bank_id')->references('id')->on('res_bank');
            $table->foreign('currency_id')->references('id')->on('res_currency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res_partner_title');
        Schema::dropIfExists('res_partner_industry');
        Schema::dropIfExists('res_partner');
        Schema::dropIfExists('res_partner_bank');
    }
};
