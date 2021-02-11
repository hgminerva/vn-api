<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstitutionIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_applications', function (Blueprint $table) {
            $table->integer('institution_id')->unsigned();
            $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_applications', function (Blueprint $table) {
            //
        });
    }
}
