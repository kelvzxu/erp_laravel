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
        Schema::create('res_currency', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->float('rounding');
            $table->integer('decimal_places');
            $table->enum('position',['after','before'])->default('after');
            $table->string('currency_unit_label')->nullable();
            $table->string('currency_subunit_label')->nullable();
            $table->timestamps();
        });

        Schema::create('res_lang', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('iso_code')->nullable();
            $table->string('url_code')->nullable();
            $table->string('direction');
            $table->string('date_format');
            $table->string('time_format');
            $table->enum('week_start', [
                'Monday', 
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'])->default('Monday');
            $table->string('grouping');
            $table->string('decimal_point');
            $table->string('thousands_sep')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('res_currency');
        Schema::dropIfExists('res_lang');
    }
};
