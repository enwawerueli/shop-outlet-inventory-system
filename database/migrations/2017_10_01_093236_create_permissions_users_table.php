<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        if (!Schema::hasTable('permission_user')) {
            Schema::create('permission_user', function(Blueprint $table){
                $table->integer('user_id')->foreign()->references('id')->on('users')->onDelete('cascade');
                $table->integer('permission_id')->foreign()->references('id')->on('permissions')->onDelete('cascade');
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
        Schema::dropIfExists('permission_user');
    }
}
