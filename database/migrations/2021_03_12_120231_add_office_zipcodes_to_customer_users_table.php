<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOfficeZipcodesToCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_users', function (Blueprint $table) {
            $table->string('office_zipcodes')->nullable();
            $table->bigInteger('office_us_state_id')->unsigned()->nullable();
            $table->bigInteger('office_us_state_category_id')->unsigned()->nullable();

            $table->foreign('office_us_state_id')->references('id')->on('us_states');
            $table->foreign('office_us_state_category_id')->references('id')->on('us_state_categories');
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
