<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('homestay_id');
            $table->integer('month');
            $table->integer('year');
            $table->float('total');
            $table->enum('status', [0, 1])->comment = "0:not paid, 1:paid";
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('homestay_id')->references('id')->on('homestays')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistic_incomes');
    }
}
