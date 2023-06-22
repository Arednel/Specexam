<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('email', 500);
            $table->string('password', 200);
            $table->string('full_name', 500);
            $table->string('iin', 200);
            $table->string('ict', 200);
            $table->string('speciality', 500);
            $table->string('educational_institution', 200);
            $table->string('privilege', 50);
            $table->dateTime('exam_start')->nullable();
            $table->dateTime('last_try')->nullable();
            $table->timestamps();
            $table->rememberToken();
        });
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
