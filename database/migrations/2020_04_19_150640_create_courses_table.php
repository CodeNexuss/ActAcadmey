<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('courses');
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('parent_category_id')->nullable();
            $table->integer('second_category_id')->nullable();
            $table->integer('category_id')->nullable();

            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->text('benefits')->nullable();
            $table->text('requirements')->nullable();
            $table->string('price_plan', 20)->nullable();

            $table->decimal('price', 16)->nullable();
            $table->decimal('sale_price', 16)->nullable();

            $table->tinyInteger('level')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable(); //0:draft, 1:publish, 2:pending, 3:block, 4:unpublish

            $table->tinyInteger('is_presale')->default(0)->nullable();
            $table->timestamp('launch_at')->nullable();
            $table->integer('thumbnail_id')->nullable();
            $table->text('video_src')->nullable();
            $table->integer('total_video_time')->nullable();

            $table->integer('require_enroll')->default(1)->nullable(); //if free
            $table->integer('require_login')->default(1)->nullable(); // if free

            $table->tinyInteger('total_lectures')->default(0)->nullable();
            $table->tinyInteger('total_assignments')->default(0)->nullable();
            $table->tinyInteger('total_quiz')->default(0)->nullable();
            $table->integer('total_sales')->default(0)->nullable();

            $table->decimal('rating_value', 3)->default(0)->nullable();
            $table->tinyInteger('rating_count')->default(0)->nullable();
            $table->tinyInteger('five_star_count')->default(0)->nullable();
            $table->tinyInteger('four_star_count')->default(0)->nullable();
            $table->tinyInteger('three_star_count')->default(0)->nullable();
            $table->tinyInteger('two_star_count')->default(0)->nullable();
            $table->tinyInteger('one_star_count')->default(0)->nullable();

            $table->tinyInteger('is_featured')->nullable();
            $table->timestamp('featured_at')->nullable();
            $table->tinyInteger('is_popular')->nullable();
            $table->timestamp('popular_added_at')->nullable();
            $table->tinyInteger('is_top')->nullable();


            $table->timestamp('last_updated_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->bigInteger('view_count')->default(0)->nullable();
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
        Schema::dropIfExists('courses');
    }
}
