<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->uuid('inviter_code')->nullable();
            $table->string('image_url')->default('public/sampleImage/my-page.svg');
            $table->string('first_name_kana')->default("");
            $table->string('last_name_kana')->default("");
            $table->string('first_name')->default("");
            $table->string('last_name')->default("");
            $table->date('birthday')->nullable();
            $table->string('gender')->default("");
            $table->string('introduction')->default("");
            $table->string('phone_number')->default("");
            $table->boolean('birthday_is_published')->default(false);
            $table->boolean('gender_is_published')->default(false);
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
        Schema::dropIfExists('profiles');
    }
}
