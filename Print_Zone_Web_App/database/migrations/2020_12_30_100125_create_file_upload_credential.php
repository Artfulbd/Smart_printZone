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
        Schema::create('_cread96a4f3p', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->integer('max_file_count');
            $table->double('max_size_total');
            $table->text('server_dir');
            $table->text('hidden_dir')->nullable();
            $table->text('temp_dir')->nullable();
            $table->timestamps();
        });

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
