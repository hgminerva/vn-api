<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsStateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('us_state_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('us_state_id')->unsigned();
            $table->foreign('us_state_id')->references('id')->on('us_states');
            $table->text('question');
            $table->bigInteger('question_value');
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
        Schema::dropIfExists('us_state_questions');
    }
}
