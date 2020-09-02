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
            $table->id();
            $table->string('sku');
            $table->string('name')->nullable();
            $table->float('price');
            $table->float('offer');
            $table->string('description');
            $table->integer('qty');
            $table->string('avatar');
            $table->string('variants')->nullable();
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
