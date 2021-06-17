<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompositeUniqueBetweenEmailAndExistAtTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropUnique('talents_email_unique');

            $table->boolean('exist')->nullable()->storedAs('case when deleted_at is null then 1 else null end');

            $table->unique(['email', 'exist']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->dropUnique(['email', 'exist']);
            $table->dropColumn('exist');
            $table->unique('email');
        });
    }
}
