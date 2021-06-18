<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthday')->after('password');
            $table->string('gender')->after('birthday');
            $table->string('introduction')->after('gender');
            $table->boolean('birthday_is_published')->after('introduction');
            $table->boolean('gender_is_published')->after('birthday_is_published');
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('introduction');
            $table->dropColumn('birthday_is_published');
            $table->dropColumn('gender_is_published');
            $table->dropColumn('deleted_at');
        });
    }
}
