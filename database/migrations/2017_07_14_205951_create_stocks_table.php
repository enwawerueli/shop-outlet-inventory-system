<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        if(!Schema::hasTable('stocks')){
            Schema::create('stocks', function (Blueprint $table){
                $table->increments('id');
                $table->integer('product_id')->foreign()->references('id')->on('products')->onDelete('cascade');
                $table->integer('qty')->default(0);
                $table->integer('min_qty')->default(0);
                $table->decimal('value', 9, 2);
                $table->timestamps();
            });
        }
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
