<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discussions');
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->default(0)->nullable();
            $table->integer('content_id')->default(0)->nullable();
            $table->integer('instructor_id')->default(0)->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->integer('discussion_id')->default(0)->nullable();
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('replied')->default(0)->nullable();
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
        Schema::dropIfExists('discussions');
    }
}
