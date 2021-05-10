<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printe3242342r_status234232077', function (Blueprint $table) {
            $table->integer('printer_id')->primary();
            $table->integer('u_id')->nullable();
            $table->integer('required_time')->default(0);
            $table->timestamps();

            $table->foreign('printer_id')->references('printer_id')->on('print43er_details234c23452')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('printer_status');
    }
}
