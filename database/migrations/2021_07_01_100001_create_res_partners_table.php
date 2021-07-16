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
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->foreignId('title')->nullable()->references('id')->on('res_partner_title');
            $table->foreignId('parent_id')->nullable()->references('id')->on('res_partners');
            $table->string('ref')->nullable();
            $table->string('lang')->nullable();
            $table->string('tz')->nullable();
            $table->string('vat')->nullable();
            $table->string('website')->nullable();
            $table->text('comment')->nullable();
            $table->string('type')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('employee')->nullable();
            $table->string('street')->nullable();
            $table->string('street2')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->foreignId('state_id')->nullable()->references('id')->on('res_country_state');
            $table->foreignId('country_id')->nullable()->references('id')->on('res_country');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->boolean('is_company')->nullable();
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
        Schema::dropIfExists('res_partners');
    }
}
