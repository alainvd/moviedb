<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('name', 400);
            $table->unsignedBigInteger('action_id');
            $table->integer('year');
            $table->longText('description')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->dateTime('deadline1')->nullable();
            $table->dateTime('deadline2')->nullable();
            $table->enum('status', ["open", "closed"])->nullable();
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
        Schema::dropIfExists('calls');
    }
}
