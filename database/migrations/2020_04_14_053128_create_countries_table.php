<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('countries');
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('country_code', 3)->nullable();
            $table->string('currency_code', 9)->nullable();
            $table->string('currency_symbol', 3)->nullable();
            $table->integer('currency_decimals')->nullable();
            $table->string('iso2', 2)->nullable();
            $table->string('iso3', 3)->nullable();
            $table->char('continent_code', 2)->nullable();
            $table->string('name', 191)->nullable();
            $table->string('calling_code', 3)->nullable();
            $table->string('flag', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
