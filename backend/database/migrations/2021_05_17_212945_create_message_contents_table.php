<?php

use App\Enums\MessageContributor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_plan_cheering_id')->constrained('user_plan_cheering')->onDelete('cascade');
            $table->text('content');
            $table->string('file_path')->nullable();
            $table->string('file_original_name')->nullable();
            $table->enum('message_contributor', MessageContributor::getValues());
            $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('message_contents');
    }
}
