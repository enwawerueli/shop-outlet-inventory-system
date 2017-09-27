<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        if(!Schema::hasTable('sales')){
            Schema::create('sales', function(Blueprint $table){
                $table->increments('id');
                $table->integer('product_id')->foreign()->references('id')->on('products');
                $table->integer('qty');
                $table->decimal('amount', 9, 2);
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
        Schema::dropIfExists('sales');
    }
}
