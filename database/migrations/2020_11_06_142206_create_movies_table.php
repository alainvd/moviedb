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
            $table->unsignedInteger('genre_id')->nullable();
            $table->unsignedInteger('audience_id')->nullable();
            $table->string('delivery_platform')->nullable();
            $table->integer('legacy_id')->nullable()->index();
            $table->string('original_title');
            $table->text('synopsis')->nullable();
            $table->string('imdb_url')->nullable();
            $table->string('isan')->nullable();
            $table->string('eidr')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('broadcast_date')->nullable();
            $table->integer('film_length')->nullable();
            $table->integer('number_of_episodes')->nullable();
            $table->integer('length_of_episodes')->nullable();
            $table->string('film_country_of_origin')->nullable();
            $table->string('film_country_of_origin_2014_2020')->nullable();
            $table->integer('year_of_copyright')->nullable();
            $table->bigInteger('development_costs_in_euro')->nullable();
            $table->string('film_type')->nullable();
            $table->string('film_format')->nullable();
            $table->bigInteger('total_budget_currency_amount')->nullable();
            $table->string('total_budget_currency_code')->nullable();
            $table->decimal('total_budget_currency_rate')->nullable();
            $table->bigInteger('total_budget_euro')->nullable();
            $table->boolean('dev_support_flag')->nullable();
            $table->string('dev_support_reference')->nullable();
            $table->date('photography_start')->nullable();
            $table->date('photography_end')->nullable();
            $table->decimal('country_of_origin_points')->nullable();
            $table->string('user_experience')->nullable();
            //DEV Previous work link to the applicant
            $table->string('link_applicant_work')->nullable();
            $table->string('link_applicant_work_person_name')->nullable();
            $table->string('link_applicant_work_person_position')->nullable();
            $table->string('link_applicant_work_person_credit')->nullable();
            //DEV Current work ownership of rights
            $table->string('rights_origin_of_work')->nullable();
            $table->string('rights_contract_type')->nullable();
            $table->date('rights_contract_start_date')->nullable();
            $table->date('rights_contract_end_date')->nullable();
            $table->date('rights_contract_signature_date')->nullable();
            $table->string('rights_adapt_author_name')->nullable();
            $table->string('rights_adapt_original_title')->nullable();
            $table->string('rights_adapt_contract_type')->nullable();
            $table->date('rights_adapt_contract_start_date')->nullable();
            $table->date('rights_adapt_contract_end_date')->nullable();
            $table->date('rights_adapt_contract_signature_date')->nullable();

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
