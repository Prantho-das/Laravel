<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecilizationOfDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specilization_of_doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->text('highest_degree_one')->nullable()->trim();
            $table->text('highest_degree_two')->nullable()->trim();
            $table->text('highest_degree_three')->nullable()->trim();
            $table->text('highest_degree_four')->nullable()->trim();
            $table->text('specilization')->nullable()->trim();
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
        Schema::dropIfExists('specilization_of_doctors');
    }
}
