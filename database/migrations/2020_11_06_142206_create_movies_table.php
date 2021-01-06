<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('legacy_id')->nullable();
            $table->string('original_title', 255);
            $table->string('logline', 4000)->nullable();
            $table->string('imdb_url')->nullable();
            $table->string('isan', 255)->nullable();
            $table->string('eidr', 255)->nullable();
            $table->date('shooting_start')->nullable();
            $table->date('shooting_end')->nullable();
            $table->string('film_length')->nullable();
            $table->integer('number_of_episodes')->nullable();
            $table->integer('length_of_episodes')->nullable();
            $table->string('film_country_of_origin')->nullable();
            $table->integer('year_of_copyright')->nullable();
            $table->integer('directors_film')->nullable();
            $table->string('european_nationality_flag',255)->nullable();
            $table->longText('european_nationality_basis')->nullable();
            $table->bigInteger('development_costs_in_euro')->nullable();
            $table->string('production_costs_currency_date')->nullable();
            $table->string('production_costs_currency')->nullable();
            $table->bigInteger('production_costs')->nullable();
            $table->bigInteger('production_costs_in_euro')->nullable();
            $table->string('film_type')->nullable();
            $table->string('film_format')->nullable();
            $table->decimal('film_score')->nullable();
            //$table->string('username')->nullable();
            //$table->date('audit_date')->nullable();
            //$table->date('eu_net_change_date')->nullable();
            //$table->date('eu_net_change_name')->nullable();
            $table->text('synopsis')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
