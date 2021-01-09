<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_file', function (Blueprint $table) {
                $table->bigInteger('id');
                $table->text('file_name');
                $table->integer('pg_count');
                $table->double('size');
                $table->tinyInteger('is_online')->default('1');
                $table->timestamps();

                //$table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pending_file');
    }
}
