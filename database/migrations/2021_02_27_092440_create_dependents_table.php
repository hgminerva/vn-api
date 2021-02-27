<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('customer_user_id')->unsigned();
            $table->foreign('customer_user_id')->references('id')->on('customer_users');

            $table->bigInteger('customer_user_dependent_id')->unsigned();
            $table->foreign('customer_user_dependent_id')->references('id')->on('customer_users');

            $table->string('relationship');
            $table->text('remarks');

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
        Schema::dropIfExists('dependents');
    }
}
