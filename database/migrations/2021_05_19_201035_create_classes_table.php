<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_name')->unique();
            $table->string('class_code');
            $table->integer('class_size');
            $table->unsignedBigInteger('academic_year_id');
            $table->unsignedBigInteger('academic_level_id');
            $table->unsignedBigInteger('programme_id');
            $table->unsignedBigInteger('dept_id');
            $table->unsignedBigInteger('session');
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
        Schema::dropIfExists('classes');
    }
}
