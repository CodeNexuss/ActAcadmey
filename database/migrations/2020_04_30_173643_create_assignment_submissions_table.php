<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('assignment_submissions');
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('assignment_id')->nullable();
            $table->integer('instructor_id')->nullable();
            $table->longText('text_submission')->nullable();
            $table->decimal('earned_numbers')->nullable();
            $table->text('instructors_note')->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('is_evaluated')->default(0)->nullable();
            $table->timestamp('evaluated_at')->nullable();
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
        Schema::dropIfExists('assignment_submissions');
    }
}
