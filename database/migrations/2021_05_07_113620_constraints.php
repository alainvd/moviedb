<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Constraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('actions');
        });
        Schema::table('movies', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('audience_id')->references('id')->on('audiences');
        });
        Schema::table('video_games', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('audience_id')->references('id')->on('audiences');
        });
        Schema::table('dossiers', function (Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
        Schema::table('crews', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('movie_language', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('language_id')->references('id')->on('languages');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('action_activity', function (Blueprint $table) {
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('action_id')->references('id')->on('actions');
        });
        Schema::table('distributor_movie', function (Blueprint $table) {
            $table->foreign('distributor_id')->references('id')->on('distributors');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('dossier_fiche', function (Blueprint $table) {
            $table->foreign('fiche_id')->references('id')->on('fiches');
            $table->foreign('dossier_id')->references('id')->on('dossiers');
            $table->foreign('activity_id')->references('id')->on('activities');
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
        });
        Schema::table('sales_distributors', function (Blueprint $table) {
            $table->foreign('movie_id')->references('id')->on('movies');
        });

        /*
        Schema::table('', function (Blueprint $table) {
            $table->foreign('')->references('id')->on('');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
