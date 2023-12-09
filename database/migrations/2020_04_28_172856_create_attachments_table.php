<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('attachments');
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable(); //Course Attachments

            $table->integer('belongs_course_id')->nullable(); //Course ID > Section ID > Item ID
            $table->integer('assignment_submission_id')->nullable();
            $table->integer('content_id')->nullable();
            $table->integer('user_id')->nullable(); //Instructor ID
            $table->integer('media_id')->nullable();
            $table->string('hash_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
