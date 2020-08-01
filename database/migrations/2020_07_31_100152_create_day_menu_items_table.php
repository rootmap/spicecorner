<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDayMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day_id');
            $table->string('day_id_name');
            $table->integer('category_id');
            $table->string('category_id_name');
            $table->string('name');
            $table->string('price');
            $table->string('description');
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
        Schema::dropIfExists('day_menu_items');
    }
}
