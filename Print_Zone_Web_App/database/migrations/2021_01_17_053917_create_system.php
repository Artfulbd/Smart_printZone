<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('system', function (Blueprint $table) {
            $table->bigInteger('system_id')->primary();
            $table->integer('status');
            $table->timestamps();
        });


        DB::table('system')->insert(
            array(
                [
                    'system_id' => 1,
                    'status'=> 0,
                    'created_at'=> now(),
                ],
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
        Schema::dropIfExists('system');
    }
}
