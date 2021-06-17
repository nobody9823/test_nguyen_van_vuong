<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayJpIdColumnToUserPlanCheeringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plan_cheering', function (Blueprint $table) {
            $table->string('pay_jp_id')->nullable()->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_plan_cheering', function (Blueprint $table) {
            $table->dropColumn('pay_jp_id');
        });
    }
}
