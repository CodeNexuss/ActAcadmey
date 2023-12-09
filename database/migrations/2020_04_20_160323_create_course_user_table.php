<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('course_user');
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('permissions')->nullable();
            $table->timestamp('added_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_user');
    }
}
