<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('enrolls');
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->default(0)->nullable();
            $table->integer('user_id')->default(0)->nullable();
            $table->decimal('course_price', 16)->nullable();
            $table->integer('payment_id')->default(0)->nullable();
            $table->string('status', 30)->default('pending')->nullable();
            $table->timestamp('enrolled_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolls');
    }
}
