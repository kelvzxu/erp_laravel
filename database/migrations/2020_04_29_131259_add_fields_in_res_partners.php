<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInResPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('res_partners', function (Blueprint $table) {
            $table->integer('mcd')->nullable()->index();
            $table->integer('payment_terms')->nullable();
            $table->integer('receivable_account')->nullable()->index();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('res_partners', function (Blueprint $table) {
            //
        });
    }
}
