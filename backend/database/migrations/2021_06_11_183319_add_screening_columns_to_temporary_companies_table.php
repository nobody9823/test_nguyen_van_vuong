<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScreeningColumnsToTemporaryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temporary_companies', function (Blueprint $table) {
            $table->string('office_address')->after('password');
            $table->string('phone_number')->after('office_address');
            $table->string('certificate_file_1')->after('image_url');
            $table->string('certificate_file_2')->after('certificate_file_1');
            $table->string('certificate_file_3')->after('certificate_file_2');
            $table->string('recognition_of_service')->after('certificate_file_3');
            $table->string('bank_name')->after('recognition_of_service');
            $table->string('bank_branch_name')->after('bank_name');
            $table->string('bank_account_number')->after('bank_branch_name');
            $table->string('bank_account_holder')->after('bank_account_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temporary_companies', function (Blueprint $table) {
            $table->dropColumn('office_address');
            $table->dropColumn('phone_number');
            $table->dropColumn('certificate_file_1');
            $table->dropColumn('certificate_file_2');
            $table->dropColumn('certificate_file_3');
            $table->dropColumn('recognition_of_service');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_branch_name');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_account_holder');
        });
    }
}
