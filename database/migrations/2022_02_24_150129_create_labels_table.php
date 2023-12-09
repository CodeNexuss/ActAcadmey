<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label_name', 30);
            $table->string('label_color', 30);
            $table->integer('number_of_sales')->nullable();
            $table->string('min_avg_ratings')->nullable();
            $table->integer('number_of_recent_days')->nullable();
            $table->integer('min_ratings_count')->nullable();
            $table->integer('number_of_days_from_arrived')->nullable();
            $table->integer('order');
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
        Schema::dropIfExists('labels');
    }
}
