<?php
//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//class CreateVideoGamesTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('video_games', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//
//            $table->string('original_name', 255);
//            $table->integer('igdb')->nullable();
//            $table->integer('publisher')->nullable();
//            $table->integer('developer')->nullable();
//
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
//        Schema::dropIfExists('video_games');
//    }
//}
