<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub__menus', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->nullable(false);
            $table->string('submenu_name')->nullable(false);
            $table->string('submenu_url')->nullable(false);
            $table->string('submenu_display')->nullable(false);
            $table->integer('submenu_order')->nullable(false);
            $table->integer('submenu_status')->nullable(false);
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
        Schema::dropIfExists('sub__menus');
    }
}
