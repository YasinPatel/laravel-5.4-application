<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name',255)->nullable();
            $table->string('phone_number',255)->nullable();
            $table->string('email_id',255)->nullable();
            $table->string('image_path',255)->nullable();
            $table->string('password',255)->nullable();
            $table->enum('user_type', ['A', 'U'])->default('U');
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->enum('is_deleted', ['Y', 'N'])->default('N');
            $table->integer('i_by')->length(10)->unsigned()->nullable();
            $table->integer('u_by')->length(10)->unsigned()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user_master');
    }
}
