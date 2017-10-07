<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_master', function (Blueprint $table) {
          $table->text('google_token',255)->nullable();
          $table->text('facebook_token',255)->nullable();
          $table->string('image_url',255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_master', function (Blueprint $table) {
            //
            $table->dropColumn(['google_token', 'facebook_token', 'image_url']);

        });
    }
}
