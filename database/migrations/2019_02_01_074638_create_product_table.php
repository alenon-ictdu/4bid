<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
            $table->string('user_id');
            $table->string('name');
            $table->string('price')->nullable();
            $table->string('color')->nullable();
            $table->string('style');
            $table->string('brand');
            $table->string('series');
            $table->string('denomination');
            $table->string('piston');
            $table->integer('cylinder');
            $table->string('fuel');
            $table->string('milage');
            $table->string('year');
            $table->string('duration');
            $table->integer('status');
            $table->integer('status2')->nullable();
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
        Schema::dropIfExists('product');
    }
}
