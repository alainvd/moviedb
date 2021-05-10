<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideogamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_games', function (Blueprint $table) {
            $table->id();
            $table->string('original_title')->nullable();
            $table->integer('year_of_copyright')->nullable();
            $table->text('synopsis')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable()->references('id')->on('genres');
            $table->unsignedBigInteger('audience_id')->nullable()->references('id')->on('audiences');
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
        Schema::dropIfExists('video_games');
    }
}
