<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\MessageStatus;
use App\Enums\PaymentWay;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('project_id')->constrained('projects');
            $table->integer('inviter_id')->nullable();
            $table->integer('price');
            $table->enum('message_status', MessageStatus::getValues())->default('ステータスなし');
            $table->enum('payment_way', PaymentWay::getValues());
            // $table->string('merchant_payment_id')->unique();
            // $table->string('pay_jp_id')->unique()->nullable();
            $table->boolean('payment_is_finished')->default(false);
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
