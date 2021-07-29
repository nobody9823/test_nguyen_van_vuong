<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPsReturnColumnToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('ps_plan_content', 'reward_by_total_amount');
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->mediumText('reward_by_total_quantity')->after('reward_by_total_amount');
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
            $table->dropColumn('reward_by_total_quantity');
            $table->renameColumn('reward_by_total_amount', 'ps_plan_content');
        });
    }
}
