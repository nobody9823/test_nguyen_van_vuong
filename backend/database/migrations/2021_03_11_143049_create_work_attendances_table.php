<?php

use App\Enums\WorkShiftLastUpdater;
use App\Enums\WorkShiftStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_shift_id')->constrained('work_shifts')->cascadeOnDelete()->unique()->comment('ここ外部キー+ユニーク部分なので、DB出来る人確認してほしい');
            $table->time('attendance_from')->nullable();
            $table->time('attendance_to')->nullable();
            $table->integer('work_rest_minutes')->nullable();
            $table->enum('status', WorkShiftStatus::getValues())->comment('ステータス全く同じなのでshiftを流用');
            $table->enum('last_updater', WorkShiftLastUpdater::getValues())->comment('ステータス全く同じなのでshiftを流用');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('work_attendances');
    }
}
