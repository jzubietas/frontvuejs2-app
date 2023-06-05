<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStakeHoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stakeholders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable()->default('');
            $table->string('description')->nullable()->default('');
            $table->string('coment')->nullable()->default('');
            
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->index('stakeholder_type_id');

            $table->index('project_id');

            $table->foreign('stakeholder_type_id')->references('id')->on('stakeholder_types')->onDelete('cascade');

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stakeholders');
    }
}
