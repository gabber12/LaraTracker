<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkClickTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link_id');
            $table->string('language');
            $table->string('browser');
            $table->string('browser_version');
            $table->string('os');
            $table->string('os_version');
            $table->string('device');
            $table->string('ip');
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
        Schema::dropIfExists('link_clicks');
    }
}
