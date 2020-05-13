<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_rights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->boolean('sales')->nullable()->default(False);
            $table->boolean('purchase')->nullable()->default(False);
            $table->boolean('inventory')->nullable()->default(False);
            $table->boolean('accounting')->nullable()->default(False);
            $table->boolean('point_of_sale')->nullable()->default(False);
            $table->boolean('human_resources')->nullable()->default(False);
            $table->boolean('administration')->nullable()->default(False);
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
        Schema::dropIfExists('access_rights');
    }
}
