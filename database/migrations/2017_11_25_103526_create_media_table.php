<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::dropIfExists('media');
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('slug')->nullable();
            $table->string('slug_ext')->nullable();
            $table->string('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->text('metadata')->nullable();
            $table->integer('sort_order')->default(0)->nullable();;
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
        Schema::dropIfExists('media');
    }
}
