<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantPaymentIdColumnToUserPlanCheering extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_plan_cheering', function (Blueprint $table) {
            $table->string('merchant_payment_id')->unique();
            $table->boolean('payment_is_finished')->default(false);
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
            $table->dropColumn('merchant_payment_id');
            $table->dropColumn('payment_is_finished');
        });
    }
}
