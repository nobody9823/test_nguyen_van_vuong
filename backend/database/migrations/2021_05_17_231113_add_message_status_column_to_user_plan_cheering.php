<?php

use App\Enums\MessageStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMessageStatusColumnToUserPlanCheering extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plan_cheering', function (Blueprint $table) {
            $table->enum('message_status', MessageStatus::getValues());
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
            $table->dropColumn('message_status');
        });
    }
}
