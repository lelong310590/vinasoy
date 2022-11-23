<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vv_videos', function (Blueprint $table) {
            //
            $table->string('video_author_name')->nullable();
            $table->string('video_author_email')->nullable();
            $table->string('video_author_phone')->nullable();
            $table->string('video_author_address')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vv_videos', function (Blueprint $table) {
            //
            $table->dropColumn('video_author_name');
            $table->dropColumn('video_author_email');
            $table->dropColumn('video_author_phone');
            $table->dropColumn('video_author_address');
            $table->dropColumn('guardian_name');
            $table->dropColumn('guardian_phone');
            $table->dropColumn('guardian_email');
        });
    }
}
