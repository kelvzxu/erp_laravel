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
            $table->id();
            $table->string('name');
            $table->foreignId('partner_id')->index();
            $table->foreignId('currency_id')->index();
            $table->foreignId('parent_id')->nullable()->references('id')->on('res_companies');
            $table->string('company_registry')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
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
