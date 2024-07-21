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
        Schema::create('res_country', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->unsignedBigInteger('currency_id');
            $table->integer('phone_code');
            $table->string('vat_label')->nullable();
            $table->boolean('state_required')->default(True);
            $table->boolean('zip_required')->default(True);
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on('res_currency');
        });

        Schema::create('res_country_state', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('res_country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res_country');
        Schema::dropIfExists('res_country_state');
    }
};
