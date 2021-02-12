<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccine_urls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('us_state_id')->unsigned();
            $table->foreign('us_state_id')->references('id')->on('us_states');
            $table->text('url_address');
            $table->text('current_content');
            $table->text('previous_content');
            $table->string('zipcodes');
            $table->string('remarks');
            $table->boolean('enabled');
            $table->softDeletes();
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
        Schema::dropIfExists('vaccine_urls');
    }
}
