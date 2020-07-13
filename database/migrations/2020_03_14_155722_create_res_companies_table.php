<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->nullable();
            $table->string('display_name')->nullable();
            $table->integer('currency_id')->nullable()->index();
            $table->integer('parent_id')->nullable();
            $table->string('vat')->nullable();
            $table->string('email')->nullable();
            $table->string('Phone')->nullable(); 
            $table->string('website')->nullable();
            $table->string('icon')->nullable();
            $table->string('photo')->nullable();
            $table->string('company_registry')->nullable();
            $table->string('address')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->integer('state_id')->nullable()->index();
            $table->integer('country_id')->nullable()->index();
            $table->string('partner_latitude')->nullable();
            $table->string('partner_longitude')->nullable();
            $table->string('social_twitter')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_youtube')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_github')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('tax_id')->nullable();
            $table->integer('bank_account')->nullable();
            $table->integer('bank_account2')->nullable();
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
        Schema::dropIfExists('res_companies');
    }
}
