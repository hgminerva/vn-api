<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAreaToInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('institutions', function (Blueprint $table) {
            $table->string('area')->default('null');
            $table->string('image_url')->default('null');
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
