<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkHistoryToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('work_history')->default('null');
            $table->string('qualifications')->default('null');
            $table->string('awards')->default('null');
            $table->string('place_of_residency')->default('null');
            $table->string('remarks')->default('null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            //
        });
    }
}
