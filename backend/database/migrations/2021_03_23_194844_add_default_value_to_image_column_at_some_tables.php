<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultValueToImageColumnAtSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });
        Schema::table('temporary_companies', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });
        Schema::table('plans', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });
        Schema::table('activity_report_images', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });
        Schema::table('supporter_comments', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/now_printing.png')->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/person_sample.jpg')->change();
        });
        Schema::table('temporary_talents', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/person_sample.jpg')->change();
        });
        Schema::table('talents', function (Blueprint $table) {
            $table->string('image_url')->default('public/sampleImage/person_sample.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('image_url')->default('public/image/sampleCompany.jpg')->change();
        });
        Schema::table('temporary_companies', function (Blueprint $table) {
            $table->string('image_url')->nullable()->change();
        });
        Schema::table('project_images', function (Blueprint $table) {
            $table->string('image_url')->change();
        });
        Schema::table('plans', function (Blueprint $table) {
            $table->string('image_url')->nullable()->change();
        });
        Schema::table('activity_report_images', function (Blueprint $table) {
            $table->string('image_url')->change();
        });
        Schema::table('supporter_comments', function (Blueprint $table) {
            $table->string('image_url')->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('image_url')->default('public/image/person_sample.jpg')->change();
        });
        Schema::table('temporary_talents', function (Blueprint $table) {
            $table->string('image_url')->change();
        });
        Schema::table('talents', function (Blueprint $table) {
            $table->string('image_url')->change();
        });
    }
}
