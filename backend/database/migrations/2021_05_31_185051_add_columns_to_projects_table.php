<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('greeting_and_introduce', 5000)->after('title');
            $table->string('opportunity', 5000)->after('explanation');
            $table->string('finally', 5000)->after('opportunity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('greeting_and_introduce');
            $table->dropColumn('opportunity');
            $table->dropColumn('finally');
        });
    }
}
