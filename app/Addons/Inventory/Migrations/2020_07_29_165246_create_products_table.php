<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code',200)->unique();
            $table->string('barcode',200)->unique();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('company_id')->nullable()->index();
            $table->integer('price')->nullable()->default(0);
            $table->integer('cost')->nullable()->default(0);
            $table->integer('tax_id')->nullable()->default(0);
            $table->integer('volume')->nullable()->default(0);
            $table->integer('weight')->nullable()->default(0);
            $table->double('quantity')->nullable()->default(0);
            $table->boolean('can_be_sold')->nullable()->default(False);
            $table->boolean('can_be_purchase')->nullable()->default(False);
            $table->integer('uom_id')->nullable()->default(0);
            $table->integer('uom_po_id')->nullable()->default(0);
            $table->integer('uom_category')->nullable()->default(0);
            $table->string('photo')->nullable();
            $table->integer('create_uid');
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
        Schema::dropIfExists('products');
    }
}
