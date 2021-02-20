<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('batch_number');
            $table->date('batch_date');
            $table->text('batch_time');
            $table->bigInteger('customer_user_id')->unsigned();
            $table->foreign('customer_user_id')->references('id')->on('customer_users');
            $table->bigInteger('vaccine_url_id')->unsigned();
            $table->foreign('vaccine_url_id')->references('id')->on('vaccine_urls');
            $table->boolean('is_sms_sent');
            $table->boolean('is_email_sent');
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
        Schema::dropIfExists('notifications');
    }
}
