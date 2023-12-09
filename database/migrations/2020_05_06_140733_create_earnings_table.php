<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('earnings');
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->integer('instructor_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->decimal('amount', 16)->nullable();
            $table->decimal('instructor_amount', 16)->nullable();
            $table->decimal('admin_amount', 16)->nullable();

            $table->decimal('instructor_share', 16)->nullable();
            $table->decimal('admin_share', 16)->nullable();

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
        Schema::dropIfExists('earnings');
    }
}
