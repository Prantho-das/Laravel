<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users', 'id')->onDelete('cascade');;
            $table->boolean('doctor_status')->default(false)->comment('0 means free now & 1 means in a case');
            $table->timestamp('last_case')->nullable();
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
        Schema::dropIfExists('doctor_statuses');
    }
}
