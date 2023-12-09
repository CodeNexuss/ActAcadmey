<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('gender', 20)->nullable();
            $table->string('company_name')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->string('postcode')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->text('about_me')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('photo')->nullable();
            $table->string('job_title')->nullable();
            $table->text('options')->nullable();
            $table->string('user_type')->nullable(); //['user', 'admin', 'support', 'sub_admin']
            $table->tinyInteger('active_status')->default(0)->nullable(); //active_status 0:pending, 1:active, 2:block;

            /**
             * Social Login Fields
             */
            $table->string('provider_user_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('reset_token', 100)->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->integer('last_wished_course')->nullable();
            $table->integer('last_viewed_course')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
