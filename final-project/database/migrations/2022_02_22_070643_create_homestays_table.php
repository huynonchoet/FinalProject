<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('images');
            $table->string('price');
            $table->text('description');
            $table->integer('discount');
            $table->integer('quantity_room');
            $table->enum('status', [0, 1])->default(0)->comment = "0:normal,1:locked";
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kind_homestay_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kind_homestay_id')->references('id')->on('kind_homestay')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homestays');
    }
}
