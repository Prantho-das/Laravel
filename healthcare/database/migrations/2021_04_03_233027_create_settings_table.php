<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('title')->default("MEDICOb");
            $table->text('logo')->default("logo.svg");
            $table->text('email')->default("medicob@gmail.com");
            $table->json('contact')->default('["017XXXXXXXX","017XXXXXXXX"]');
            $table->json('social')->default('["N/A"]');
            $table->text('address')->default('N/A');
            $table->string('covidNews',4)->default('on');
            $table->integer('reassignDay')->default(2);
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
        Schema::dropIfExists('settings');
    }
}
