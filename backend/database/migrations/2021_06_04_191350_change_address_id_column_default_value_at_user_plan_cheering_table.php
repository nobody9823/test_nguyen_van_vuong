<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAddressIdColumnDefaultValueAtUserPlanCheeringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plan_cheering', function (Blueprint $table) {
            $table->integer('address_id')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
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
            $table->integer('address_id')->change();
            $table->string('phone_number')->change();
        });
    }
}
