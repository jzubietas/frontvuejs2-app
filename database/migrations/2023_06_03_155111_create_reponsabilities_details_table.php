<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsabilitiesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsabilities_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('responsability_id');
            $table->timestamps();
            $table->index('responsability_id');
            $table->foreign('responsability_id')->references('id')->on('responsabilities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sectors');
    }
}
