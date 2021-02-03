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
            $table->integer('legacy_id')->nullable()->index();
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
            $table->string('film_delivery_platform')->nullable();
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
            $table->decimal('country_of_origin_points')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('user_experience')->nullable();
            //DEV Previous work link to the applicant
            $table->text('link_applicant_work')->nullable();
            $table->text('link_applicant_work_person_name')->nullable();
            $table->text('link_applicant_work_person_position')->nullable();
            $table->text('link_applicant_work_person_credit')->nullable();
            //DEV Current work ownership of rights
            $table->text('rights_origin_of_work')->nullable();
            $table->text('rights_contract_type')->nullable();
            $table->date('rights_contract_start_date')->nullable();
            $table->date('rights_contract_end_date')->nullable();
            $table->date('rights_contract_signature_date')->nullable();
            $table->text('rights_adapt_author_name')->nullable();
            $table->text('rights_adapt_original_title')->nullable();
            $table->text('rights_adapt_contract_type')->nullable();
            $table->date('rights_adapt_contract_start_date')->nullable();
            $table->date('rights_adapt_contract_end_date')->nullable();
            $table->date('rights_adapt_contract_signature_date')->nullable();

            //Moved From Media
            $table->unsignedInteger('genre_id')->nullable();
            $table->unsignedInteger('audience_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     */
    public function down()

    {
        Schema::dropIfExists('movies');
    }
}
