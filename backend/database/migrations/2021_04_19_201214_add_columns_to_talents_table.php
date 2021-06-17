<?php

use App\Enums\EmploymentStatus;
use App\Enums\EvaluationStatus;
use App\Enums\RecruitmentStatus;
use App\Enums\ResignationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTalentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('talents', function (Blueprint $table) {
            $table->enum('recruitment_status', RecruitmentStatus::getValues());
            $table->enum('employment_status', EmploymentStatus::getValues());
            $table->enum('evaluation_status', EvaluationStatus::getValues());
            $table->enum('resignation_status', ResignationStatus::getValues());
            $table->integer('hourly_wage')->nullable();
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
            $table->dropColumn('recruitment_status');
            $table->dropColumn('employment_status');
            $table->dropColumn('evaluation_status');
            $table->dropColumn('resignation_status');
            $table->dropColumn('hourly_wage');
        });
    }
}
