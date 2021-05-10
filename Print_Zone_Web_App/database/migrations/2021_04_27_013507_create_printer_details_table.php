<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print43er_details234c23452', function (Blueprint $table) {
            $table->integer('printer_id')->autoIncrement();
            $table->integer('zone_id');
            $table->string('printer_name');
            $table->string('given_name');
            $table->string('port');
            $table->float('time_one_pg');
            $table->string('driver_name');
            $table->integer('current_status');
            $table->timestamps();

            $table->foreign('zone_id')->references('zone_id')->on('zones')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('current_status')->references('s_code')->on('printer_status_code')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_details');
    }
}
