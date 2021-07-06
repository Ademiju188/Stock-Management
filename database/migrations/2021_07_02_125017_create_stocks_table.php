<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            // $table->text('brand')->nullable();
            $table->text('description')->nullable();
            $table->text('comments')->nullable();
            $table->string('category_id');
            $table->string('expiredate')->nullable();
            // $table->integer('price');
            $table->integer('supplierprice');
            // $table->integer('quantity');
            $table->integer('stock_alert')->default(100);
            $table->string('stock_img')->default('stock.png');
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
        Schema::dropIfExists('stocks');
    }
}
