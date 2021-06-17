<?php

use App\Enums\WorkShiftLastUpdater;
use App\Enums\WorkShiftStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Symfony\Component\String\s;

class CreateWorkShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talents')->cascadeOnDelete();
            $table->date('date');
            $table->time('attendance_from')->nullable();
            $table->time('attendance_to')->nullable();
            $table->integer('work_rest_minutes')->nullable();
            $table->text('comment')->nullable();
            $table->enum('last_updater', WorkShiftLastUpdater::getValues());
            $table->enum('status', WorkShiftStatus::getValues());
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
        Schema::dropIfExists('work_shifts');
    }
}
