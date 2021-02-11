<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutionJobPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_job_posting', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned();
            $table->foreign('institution_id')->references('id')->on('institutions');
            $table->string('job_posting_number');
            $table->date('job_posting_date');
            $table->date('job_posting_expiry_date');
            $table->string('job_title');
            $table->string('job_type');
            $table->string('description');
            $table->string('requirements');
            $table->string('skills');
            $table->string('work_location');
            $table->string('keywords');
            $table->boolean('enable');
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
        Schema::dropIfExists('institution_job_posting');
    }
}
