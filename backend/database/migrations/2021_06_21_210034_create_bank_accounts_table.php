<?php

use App\Enums\BankAccountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('bank_code')->comment('金融機関コード、先頭に０が入る可能性あるのでstring、4桁バリデーション');
            $table->string('branch_code')->comment('支店コード、先頭に０が入る可能性あるのでstring、3桁バリデーション');
            $table->enum('account_type', BankAccountType::getValues());
            $table->string('account_number')->comment('口座番号、先頭に０が入る可能性あるのでstring、7桁バリデーション');
            $table->string('account_name')->comment('カタカナで姓名記入');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}
