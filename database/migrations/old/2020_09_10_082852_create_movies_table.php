<?php
//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//class CreateMoviesTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('movies', function (Blueprint $table) {
//            $table->id();
//
//            $table->string('original_title', 255);
//            $table->string('imdb_url')->nullable();
//            $table->string('isan', 255)->nullable();
//            $table->string('eidr', 255)->nullable();
//            $table->dateTime('shooting_start')->nullable();
//            $table->dateTime('shooting_end')->nullable();
//            $table->integer('year_of_copyright')->nullable();
//            $table->integer('directors_film')->nullable();
//            $table->string('european_nationality_flag',255)->nullable();
//            $table->longText('european_nationality_basis')->nullable();
//            $table->string('cost_currency')->nullable();
//            $table->date('cost_currency_date')->nullable();
//            $table->string('film_type')->nullable();
//            $table->string('film_length')->nullable();
//            $table->string('film_format')->nullable();
//            $table->string('film_decision_date')->nullable();
//            $table->string('film_country_of_origin')->nullable();
//            $table->boolean('flag_video')->default(false); // ???
//            $table->boolean('flag_2')->default(false); // ???
//            $table->boolean('flag_not_use')->default(false); // ???
//            $table->integer('source_film_id')->default(false); // ???
//            $table->string('username')->nullable();
//            $table->date('audit_date')->nullable();
//            $table->date('eu_net_change_date')->nullable();
//            $table->date('eu_net_change_name')->nullable();
//
//            $table->timestamps();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('movies');
//    }
//}
