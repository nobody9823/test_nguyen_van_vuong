<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MessageStatus;

class CreateUserPlanBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_plan_billing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('plan_id')->constrained('plans');
            $table->integer('inviter_id');
            $table->integer('address_id');
            $table->enum('message_status', MessageStatus::getValues())->default('ステータスなし');
            $table->string('merchant_payment_id')->unique();
            $table->string('pay_jp_id')->unique();
            $table->boolean('payment_is_finished')->default(false);
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
        Schema::dropIfExists('user_plan_billing');
    }
}
