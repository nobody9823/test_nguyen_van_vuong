<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUrlAtSnsLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sns_links', function (Blueprint $table) {
            $table->string('twitter_url')->default('')->change();
            $table->string('instagram_url')->default('')->change();
            $table->string('youtube_url')->default('')->change();
            $table->string('tiktok_url')->default('')->change();
            $table->string('other_url')->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sns_links', function (Blueprint $table) {
            $table->string('twitter_url')->change();
            $table->string('instagram_url')->change();
            $table->string('youtube_url')->change();
            $table->string('tiktok_url')->change();
            $table->string('other_url')->change();
        });
    }
}
