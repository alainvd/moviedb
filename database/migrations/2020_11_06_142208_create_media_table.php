<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->unsignedInteger('audience_id')->nullable();
            $table->unsignedInteger('genre_id')->nullable();
            $table->unsignedBigInteger('grantable_id');
            $table->unsignedSmallInteger('delivery_platform_id')->nullable();
            $table->string('grantable_type');
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
        Schema::dropIfExists('media');
    }
}
