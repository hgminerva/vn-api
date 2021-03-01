<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToVaccineUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaccine_urls', function (Blueprint $table) {
            $table->string('status')->default("null");
            $table->text('url_registration');
            $table->text('site_message');
            $table->string('county')->default("null");
            $table->string('phase_served')->default("null");
            $table->string('can_scrape')->default(true);
            $table->date('last_updated')->default("1970-01-01");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaccine_urls', function (Blueprint $table) {
            //
        });
    }
}
