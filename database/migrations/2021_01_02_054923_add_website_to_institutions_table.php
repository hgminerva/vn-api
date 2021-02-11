<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWebsiteToInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('website')->default('null');
            $table->string('founder_name')->default('null');
            $table->string('manager_name')->default('null');
            $table->string('facility_type')->default('null');
            $table->string('medical_department')->default('null');
            $table->integer('number_of_staffs')->default(0);
            $table->integer('number_of_hospital_beds')->default(0);
            $table->integer('number_of_patients_a_day')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('institutions', function (Blueprint $table) {
            //
        });
    }
}
