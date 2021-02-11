<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLivingWithFamilyToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('living_with_family')->nullable();
            $table->string('have_dependents')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('specialist')->nullable();
            $table->string('certified_physician')->nullable();
            $table->string('area_of_expertise')->nullable();
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
