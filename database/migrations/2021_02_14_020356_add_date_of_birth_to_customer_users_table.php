<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateOfBirthToCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->date('date_of_birth');
            $table->string('age_group');
            $table->date('enrollment_date');
            $table->date('enrollment_out_date');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('employment_number');
            $table->string('employment_type');
            $table->string('employment_county');
            $table->string('home_county');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            //
        });
    }
}
