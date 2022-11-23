<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Botble\ACL\Models\User;

class CreateVideoVotingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vv_video_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->string('icon', 60)->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::create('vv_videos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('author_id');
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('image', 255)->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->integer('vote')->nullable()->default(0);
            $table->integer('vote_fake')->nullable()->default(150);
            $table->string('age_group')->nullable();
            $table->string('video_link', 255)->nullable();
            $table->string('youtube_link', 255)->nullable();
            $table->string('video_topic', 255)->nullable();
            $table->timestamps();
        });

        Schema::create('vv_video_category_relation', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned()->references('id')->on('vv_video_categories')->onDelete('cascade');
            $table->integer('video_id')->unsigned()->references('id')->on('vv_videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('vv_video_category_relation');
        Schema::dropIfExists('vv_videos');
        Schema::dropIfExists('vv_video_categories');
    }
}
