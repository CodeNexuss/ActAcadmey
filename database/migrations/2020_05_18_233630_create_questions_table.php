<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('questions');
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->string('title')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('type', 20)->nullable();
            $table->decimal('score',5,1)->nullable();
            $table->integer('sort_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
