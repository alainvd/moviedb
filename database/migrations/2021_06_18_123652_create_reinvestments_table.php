<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReinvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reinvestments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiche_id')->nullable();
            $table->text('type_subtype')->nullable();
            $table->bigInteger('grant')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('reinvestments');
    }
}
