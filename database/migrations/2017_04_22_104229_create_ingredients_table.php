<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->double('calories')->nullable();
            $table->double('proteins')->nullable();
            $table->double('lipids')->nullable();
            $table->double('carbs')->nullable();
            $table->double('fibers')->nullable();
            $table->text('description')->nullable();
            $table->string('unit');
            $table->integer('class');
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
        Schema::dropIfExists('ingredients');
    }
}
