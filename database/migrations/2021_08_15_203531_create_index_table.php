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
            $table->text('desc_banner')->nullable();
            $table->text('sub_desc_banner')->nullable();
            $table->text('title_serve')->nullable();
            $table->text('icon_serve')->nullable();
            $table->text('desc_serve')->nullable();
            $table->text('image_step')->nullable();
            $table->text('desc_step')->nullable();
            $table->text('sub_desc_step')->nullable();
            $table->text('desc_number_step')->nullable();
            $table->text('sub_desc_number_step')->nullable();
            $table->text('image_backgound')->nullable();
            $table->text('decs_to_do')->nullable();
            $table->text('sub_desc_to_do')->nullable();
            $table->text('icon_to_do')->nullable();
            $table->text('desc_icon_to_do')->nullable();
            $table->text('sub_desc_icon_to_do')->nullable();
            $table->text('image_to_do')->nullable();
            $table->text('desc_contact')->nullable();
            $table->text('phone_contact')->nullable();
            $table->text('address_contact')->nullable();
            $table->text('email_contact')->nullable();
            $table->text('banner_buy_card')->nullable();
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
