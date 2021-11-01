<?php

use App\Enums\PaymentJobCd;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiConnectingColumnsToPaymentTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_tokens', function (Blueprint $table) {
            $table->renameColumn('token', 'order_id');
            $table->string('access_id')->nullable();
            $table->string('access_pass')->nullable();
            $table->enum('job_cd', PaymentJobCd::getValues());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_tokens', function (Blueprint $table) {
            $table->dropColumn('job_cd');
            $table->dropColumn('access_pass');
            $table->dropColumn('access_id');
            $table->renameColumn('order_id', 'token');
        });
    }
}
