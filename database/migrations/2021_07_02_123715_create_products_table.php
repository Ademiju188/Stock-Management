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
            $table->increments('id');
            $table->string('product_name');
            $table->text('description')->nullable();
            $table->text('brand');
            $table->string('category_id');
            $table->string('expiredate');
            $table->integer('price');
            // $table->integer('supplierprice');
            $table->integer('quantity');
            // $table->integer('stock_alert')->default(100);
            $table->string('product_img')->default('product.png');
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
        Schema::dropIfExists('products');
    }
}
