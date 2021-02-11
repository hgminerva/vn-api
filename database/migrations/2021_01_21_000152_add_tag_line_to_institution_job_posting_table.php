<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTagLineToInstitutionJobPostingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->string('tag_line')->nullable();
            $table->string('recruitment_background')->nullable();
            $table->string('recommended_points')->nullable();
            $table->string('number_of_working_days')->nullable();
            $table->string('starting_date_of_work')->nullable();
            $table->string('required_qualification')->nullable();
            $table->string('minimum_experience_years')->nullable();
            $table->string('welcomed_experience')->nullable();
            $table->string('with_duty')->default('無');
            $table->string('with_stand_by')->default('無');
            $table->string('with_research_day')->default('無');
            $table->string('bonus')->nullable();
            $table->string('salary_increase')->nullable();
            $table->string('various_allowances')->nullable();
            $table->string('academic_participation')->nullable();
            $table->string('assistant_academic_participation')->nullable();
            $table->string('work_life_balance')->nullable();
            $table->string('overtime')->nullable();
            $table->string('number_of_cases')->nullable();
            $table->string('doctor_system')->nullable();
            $table->string('paid_leave')->nullable();
            $table->string('other_holidays')->nullable();
            $table->string('retirement_pay')->nullable();
            $table->string('nursery')->nullable();
            $table->string('means_from_nearest_station')->nullable();
            $table->string('nearest_station')->nullable();
            $table->string('transportation')->nullable();
            $table->string('nearest_line')->nullable();
            $table->string('can_commute_by_car')->nullable();

            $table->renameColumn('job_characteristics', 'attention_points');
            $table->string('annual_salary')->change();
        });

        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->renameColumn('requirements', 'required_skills');
        });

        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->renameColumn('skills', 'desired_skills_and_experience');
        });

        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->renameColumn('benefits_and_welfare', 'various_insurances');
        });

        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->renameColumn('holiday_or_vacation', 'holidays');
        });

        Schema::table('institution_job_posting', function (Blueprint $table) {
            $table->renameColumn('annual_salary', 'salary');
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
