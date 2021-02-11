<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->integer('job_posting_id')->unsigned();
            $table->foreign('job_posting_id')->references('id')->on('institution_job_posting');
            $table->date('applied_date');
            $table->string('remarks');
            $table->string('status');
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
        Schema::dropIfExists('doctor_applications');
    }
}
