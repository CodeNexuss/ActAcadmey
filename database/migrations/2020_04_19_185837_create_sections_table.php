<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sections');
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->nullable();
            $table->string('section_name')->nullable();
            $table->timestamp('unlock_date')->nullable();
            $table->integer('unlock_days')->nullable();
            $table->tinyInteger('sort_order')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
