<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default(0);
            $table->string('name')->nullable();
            $table->string('code_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('recovery_password')->nullable();
            $table->string('phone')->nullable();
            $table->integer('point')->default(0);
            $table->integer('check_discount_code')->default(5);
            $table->integer('check_recharge_code')->default(5);
            $table->string('facebook_link')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->integer('banned_status')->default(0);
            $table->string('recovery_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
