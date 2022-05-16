<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('caselists', 'id')->onDelete('cascade');;
            $table->integer('patient_id');
            $table->integer('doctor_id');
            $table->tinyInteger('case_status')
                ->default(0)
                ->comment('0 means pending 1 means safe 2 means unclear');
            $table->timestamp('assign_date');
            $table->timestamp('release_date')->nullable();
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
        Schema::dropIfExists('assign_cases');
    }
}
