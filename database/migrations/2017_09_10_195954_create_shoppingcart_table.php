<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        if(!Schema::hasTable('cart.database.table')){
            Schema::create(config('cart.database.table'), function (Blueprint $table) {
                $table->increments('id');
                $table->string('identifier')->unique();
                $table->string('instance');
                $table->longText('content');
                $table->timestamps();
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cart.database.table'));
    }
}
