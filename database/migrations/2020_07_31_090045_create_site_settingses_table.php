<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settingses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name');
            $table->string('site_title');
            $table->string('site_description');
            $table->string('logo');
            $table->string('slider_logo');
            $table->string('contact_address');
            $table->string('contact_tel');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('fb_link');
            $table->string('twitter_link');
            $table->string('instragram_link');
            $table->string('map_source');
            $table->string('module_status');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            
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
        Schema::dropIfExists('site_settingses');
    }
}
