<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        if(!Schema::hasTable('products')){
            Schema::create('products', function(Blueprint $table){
                $table->increments('id');
                $table->string('name')->unique();
                $table->integer('category_id')->foreign()->references('id')->on('categories')->onDelete('cascade');
                $table->decimal('buying', 9, 2);
                $table->decimal('selling', 9, 2);
                $table->text('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
