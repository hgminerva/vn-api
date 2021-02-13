<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_users', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('name');
            $table->string('user_number');
            $table->string('email');
            $table->string('cellphone');
            $table->string('address');
            $table->string('zipcodes');
            $table->double('distance_willing', 15, 8);
            $table->text('keywords');
            $table->text('remarks');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('us_state_id')->unsigned();
            $table->foreign('us_state_id')->references('id')->on('us_state');
            $table->bigInteger('us_state_category_id')->unsigned();
            $table->foreign('us_state_category_id')->references('id')->on('us_state_categories');

            $table->boolean('enabled');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_users');
    }
}
