<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('images');
            $table->float('price');
            $table->text('description');
            $table->integer('discount');
            $table->integer('quantity_room');
            $table->enum('status', [0, 1])->default(0)->comment = "0:normal,1:locked";
            $table->unsignedBigInteger('homestay_id');
            $table->unsignedBigInteger('type_room_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('homestay_id')->references('id')->on('homestays')->onDelete('cascade');
            $table->foreign('type_room_id')->references('id')->on('type_rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
