<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stakeholder_id');
            $table->string('color')->nullable()->default('');
            $table->string('name');            
            $table->string('coment')->nullable()->default('');            
            $table->timestamps();
            $table->index('stakeholder_id');
            $table->foreign('stakeholder_id')->references('id')->on('stakeholders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sector_types');
    }
}
