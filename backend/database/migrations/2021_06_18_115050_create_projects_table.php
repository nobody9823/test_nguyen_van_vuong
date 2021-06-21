<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ProjectReleaseStatus;
use Carbon\Carbon;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title')->default('');
            $table->string('content', 15000)->default('');
            $table->integer('target_amount')->default(0);
            $table->date('start_date')->default(Carbon::minValue());
            $table->date('end_date')->default(Carbon::maxValue());
            $table->enum('release_status', ProjectReleaseStatus::getValues())->default('---');
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
        Schema::dropIfExists('projects');
    }
}
