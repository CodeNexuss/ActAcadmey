<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('answers');
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id')->nullable();
            $table->integer('question_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('attempt_id')->nullable();
            $table->text('answer')->nullable();
            $table->string('q_type', 20)->nullable(); //Question Type
            $table->decimal('q_score', 5, 1)->nullable(); //Question Score
            $table->decimal('r_score', 5, 1)->nullable(); //Received Score
            $table->tinyInteger('is_correct')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
