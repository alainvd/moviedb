<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crews', function (Blueprint $table) {
            $table->index('movie_id', 'crews_movie_ix');
            $table->index('person_id', 'crews_person_ix');
            $table->index('title_id', 'crews_title_ix');
        });
        Schema::table('people', function (Blueprint $table) {
            $table->index(['firstname', 'lastname'], 'people_fullname_ix');
        });
        Schema::table('fiches', function (Blueprint $table) {
            $table->index('movie_id', 'fiches_movie_ix');
            $table->index('status_id', 'fiches_status_ix');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->index('original_title', 'movies_title_ix');
        });
        Schema::table('titles', function (Blueprint $table) {
            $table->index('code', 'titles_code_ix');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crews', function (Blueprint $table) {
            $table->index('crews_movie_ix');
            $table->index('crews_person_ix');
            $table->index('crews_title_ix');
        });
        Schema::table('people', function (Blueprint $table) {
            $table->index(['firstname', 'lastname'], 'people_fullname_ix');
        });
        Schema::table('fiches', function (Blueprint $table) {
            $table->index('fiches_movie_ix');
            $table->index('fiches_status_ix');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->index('movies_title_ix');
        });
        Schema::table('titles', function (Blueprint $table) {
            $table->index('titles_code_ix');
        });
    }
}
