<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStaffsToInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('staffs')->nullable();
            $table->string('hospital_beds')->nullable();
            $table->string('patients_a_day')->nullable();
            $table->string('specialists')->nullable();
            $table->string('treatments')->nullable();
            $table->integer('number_of_specialists')->default(0);
            $table->integer('number_of_treatments')->default(0);
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
