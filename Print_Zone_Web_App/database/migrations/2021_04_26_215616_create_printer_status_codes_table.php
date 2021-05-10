<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePrinterStatusCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printer_status_code', function (Blueprint $table) {
            $table->integer('s_code')->primary();
            $table->string('status');
            $table->timestamps();
        });


        DB::table('printer_status_code')->insert(
            array(
                [
                    's_code' => 0,
                    'status' => 'OFFLINE',
                ],
                [
                    's_code' => 1,
                    'status' => 'ONLINE',
                ],
                [
                    's_code' => 2,
                    'status' => 'PRINTING STOPPED',
                ]
            )

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('printer_status_codes');
    }
}
