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
            $table->string('f_name');
            $table->string('l_name');
            $table->uuid('u_id');
            $table->string('NID');
            $table->string('email')->unique();
            $table->text('phone')->nullable();
            $table->string('role',10)->default('PATIENT')->comment('PATIENT & ADMIN & DOCTOR');
            $table->timestamp('age')->nullable();
            $table->string('gender',10)->nullable();
            $table->string('avatar')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /***
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
