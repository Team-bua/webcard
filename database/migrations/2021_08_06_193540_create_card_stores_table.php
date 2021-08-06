<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_stores', function (Blueprint $table) {
            $table->id();
            $table->string('card_type')->nullable();
            $table->string('name')->nullable();
            $table->string('price')->nullable();
            $table->string('seri_number')->nullable();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('card_stores');
    }
}
