<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admissions_table_id')->nullable();
            $table->unsignedBigInteger('fiche_id')->nullable();
            $table->string('local_title')->nullable();
            $table->date('release_date')->nullable();
            $table->integer('running_weeks')->nullable();
            $table->integer('certified_admissions')->nullable();
            $table->integer('screens_first_week')->nullable();
            $table->integer('screens_widest_release_week')->nullable();
            $table->bigInteger('box_office_receipts')->nullable();
            $table->boolean('eligibility_european_criteria_film')->nullable();
            $table->boolean('eligibility_year_copyright')->nullable();
            $table->boolean('eligibility_release_date')->nullable();
            $table->boolean('eligibility_european_criteria_distributor')->nullable();
            $table->boolean('eligibility_legal_status')->nullable();
            $table->boolean('eligibility_length')->nullable();
            $table->boolean('eligibility_european_nonnational_film')->nullable();
            $table->boolean('eligibility_other_criteria')->nullable();
            $table->boolean('eligibility_global_status')->nullable();
            $table->string('eligibility_justification')->nullable();
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
