<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('currency_id')->index()->nullable();
            $table->string('code')->nullable();
            $table->boolean('deprecated')->nullable();
            $table->integer('type')->index()->nullable();
            $table->string('internal_type')->nullable();
            $table->string('internal_group')->nullable();
            $table->boolean('reconcile')->nullable();
            $table->string('note')->nullable();
            $table->integer('company_id')->index()->nullable();
            $table->integer('root_id')->nullable();
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
        Schema::dropIfExists('account_accounts');
    }
}
