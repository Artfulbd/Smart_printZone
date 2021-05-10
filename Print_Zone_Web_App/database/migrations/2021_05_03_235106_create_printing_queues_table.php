<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prin23422ting_queue21314', function (Blueprint $table) {
            $table->integer('num');
            $table->integer('u_id');
            $table->integer('p_id');
            $table->integer('time');
            $table->integer('wait_time');
            $table->time('insertion_time')->default(now());
            $table->tinyInteger('abort');
            $table->timestamps();

            $table->foreign('p_id')->references('printer_id')->on('print43er_details234c23452')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('u_id')->references('id')->on('_user711qd9m')->onDelete('cascade')->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printing_queues');
    }
}
