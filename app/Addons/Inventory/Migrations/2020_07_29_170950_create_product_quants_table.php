<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQuantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_quants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->integer('company_id')->nullable()->index();
            $table->integer('location_id')->nullable()->index();
            $table->integer('lot_id')->nullable()->index();
            $table->integer('package_id')->nullable()->index();
            $table->integer('owner_id')->nullable()->index();
            $table->double('quantity')->nullable()->default(0);
            $table->integer('reserved_quantity')->nullable()->default(0);
            $table->integer('minimum_quantity')->nullable()->index();
            $table->integer('create_uid');
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
        Schema::dropIfExists('product_quants');
    }
}
