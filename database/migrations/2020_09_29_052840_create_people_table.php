<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id');
            $table->enum('type', ["cast","crew"]);
            $table->string('role');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('nationality1');
            $table->string('nationality2')->nullable();
            $table->string('country_of_residence');
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
        Schema::dropIfExists('people');
    }
}