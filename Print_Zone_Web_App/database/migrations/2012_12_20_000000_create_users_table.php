<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('student');
            $table->integer('admin')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });



        DB::table('users')->insert(
            array(
                [
                    'id' => 1721277,
                    'name' => 'Admin Fahad Shaheb',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('pass1234'),
                    'role' => 'super_admin',
                    'admin' => 1,
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
        Schema::dropIfExists('users');
    }
}
