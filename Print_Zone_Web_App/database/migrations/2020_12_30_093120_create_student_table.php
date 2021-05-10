<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_user711qd9m', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->default('null');
            $table->tinyInteger('status')->default('1');
            $table->integer('page_left')->default(200);
            $table->integer('total_printed')->default(0);
            $table->integer('pending')->default(0);
            $table->tinyInteger('currently_printing')->default(0);
            $table->timestamps();
            //s$table->foreign('id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
