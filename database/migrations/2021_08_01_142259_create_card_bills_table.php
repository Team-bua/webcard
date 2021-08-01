<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_bills', function (Blueprint $table) {
            $table->id();
            $table->string('card_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_price')->nullable();
            $table->string('card_total')->nullable();
            $table->string('card_info')->nullable();
            $table->string('description')->nullable();
            $table->string('price_total')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('card_bills');
    }
}
