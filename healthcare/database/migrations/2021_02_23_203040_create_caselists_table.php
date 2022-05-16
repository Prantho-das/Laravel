<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaselistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caselists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('doctor_categories', 'id')->onDelete('cascade');;
            $table->text('description')->nullable();
            $table->text('symptom_one')->nullable();
            $table->text('symptom_two')->nullable();
            $table->text('symptom_three')->nullable();
            $table->text('symptom_four')->nullable();
            $table->text('symptom_five')->nullable();
            $table->text('symptom_six')->nullable();
            $table->text('symptom_seven')->nullable();
            $table->text('symptom_eight')->nullable();
            $table->text('symptom_nine')->nullable();
            $table->text('symptom_ten')->nullable();
            $table->boolean('case_status')->default(false)->comment('0 means pending');
            $table->boolean('payment_status')->default(false)->comment('0 means payment pending 1 means payment');
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
        Schema::dropIfExists('caselists');
    }
}
