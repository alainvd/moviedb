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
            $table->string('imdb_url')->nullable();
            $table->string('isan', 255)->nullable();
            $table->string('eidr', 255)->nullable();
            $table->date('shooting_start')->nullable();
            $table->date('shooting_end')->nullable();
            $table->string('film_length')->nullable();
            $table->string('film_country_of_origin')->nullable();
            $table->integer('year_of_copyright')->nullable();
            $table->integer('directors_film')->nullable();
            $table->string('european_nationality_flag',255)->nullable();
            $table->longText('european_nationality_basis')->nullable();
            $table->string('production_costs_currency_date')->nullable();
            $table->string('production_costs_currency')->nullable();
            $table->bigInteger('production_costs')->nullable();
            $table->bigInteger('production_costs_in_euro')->nullable();
            $table->string('film_type')->nullable();
            $table->string('film_format')->nullable();
            $table->string('film_decision_date')->nullable();
            $table->decimal('country_of_origin_points')->nullable();
            $table->string('link_applicant_work')->nullable();
            $table->string('link_applicant_work_person_name')->nullable();
            $table->string('link_applicant_work_person_position')->nullable();
            $table->string('link_applicant_work_person_credit')->nullable();
            $table->integer('total_budget_currency_amount')->nullable();
            $table->string('total_budget_currency_code')->nullable();
            $table->decimal('total_budget_currency_rate')->nullable();
            $table->integer('total_budget_euro')->nullable();
            $table->boolean('flag_video')->default(false); // ???
            $table->boolean('flag_2')->default(false); // ???
            $table->boolean('flag_not_use')->default(false); // ???
            $table->integer('source_film_id')->default(false); // ???
            $table->string('username')->nullable();
            $table->date('audit_date')->nullable();
            $table->date('eu_net_change_date')->nullable();
            $table->date('eu_net_change_name')->nullable();
            $table->date('photography_start')->nullable();
            $table->date('photography_end')->nullable();
            $table->decimal('film_score')->nullable();
            //$table->string('username')->nullable();
            //$table->date('audit_date')->nullable();
            //$table->date('eu_net_change_date')->nullable();
            //$table->date('eu_net_change_name')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('user_experience')->nullable();
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
