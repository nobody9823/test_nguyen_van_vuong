<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuratorProjectManagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curator_project_managings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->foreignId('curator_id')->constrained('curators');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curator_project_managings');
    }
}
