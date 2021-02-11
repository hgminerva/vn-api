<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJobPostingTitleToInstitutionJobPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->string('job_posting_title')->default('null');
            $table->string('medical_department')->default('null');
            $table->string('area')->default('null');
            $table->decimal('annual_salary', 10, 5)->default(0.00);
            $table->string('benefits_and_welfare')->default('null');
            $table->string('holiday_or_vacation')->default('null');
            $table->string('job_characteristics')->default('null');
            $table->string('gender')->default('null');
            $table->string('working_hours')->default('null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institution_job_posting', function (Blueprint $table) {
            //
        });
    }
}
