<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadCredential extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_upload_credential', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->integer('max_file_count');
            $table->double('max_size_total');
            $table->text('storing_location');
            $table->timestamps();
        });

        DB::table('file_upload_credential')->insert(
            array(
                [
                    'max_file_count' => 6,
                    'max_size_total' => 51200,
                    'storing_location' => 'Uploaded_File/',
                    'created_at' => now(),
                    'updated_at' => now(),
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
        Schema::dropIfExists('file_upload_credential');
    }
}
