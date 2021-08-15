<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index', function (Blueprint $table) {
            $table->id();
            $table->text('image_logo')->nullable();
            $table->text('image_banner')->nullable();
            $table->string('desc_banner')->nullable();
            $table->string('sub_desc_banner')->nullable();
            $table->string('title_serve')->nullable();
            $table->string('icon_serve')->nullable();
            $table->string('desc_serve')->nullable();
            $table->string('image_step')->nullable();
            $table->string('desc_step')->nullable();
            $table->string('sub_desc_step')->nullable();
            $table->string('desc_number_step')->nullable();
            $table->string('sub_desc_number_step')->nullable();
            $table->string('image_backgound')->nullable();
            $table->string('decs_to_do')->nullable();
            $table->string('sub_desc_to_do')->nullable();
            $table->string('icon_to_do')->nullable();
            $table->string('desc_icon_to_do')->nullable();
            $table->string('sub_desc_icon_to_do')->nullable();
            $table->string('image_to_do')->nullable();
            $table->string('desc_contact')->nullable();
            $table->string('phone_contact')->nullable();
            $table->string('address_contact')->nullable();
            $table->string('email_contact')->nullable();
            $table->string('map_contact')->nullable();
            $table->string('banner_buy_card')->nullable();
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
        Schema::dropIfExists('index');
    }
}
