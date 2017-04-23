<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->integer('ingredient_id')->unsigned()->index();
            $table->integer('recipe_id')->unsigned()->index();
            $table->primary(['ingredient_id', 'recipe_id']);
        });

        Schema::table('ingredient_recipe', function($table) {
            $table->foreign('ingredient_id')
                  ->references('id')->on('ingredients')
                  ->onDelete('cascade');
            $table->foreign('recipe_id')
                  ->references('id')->on('recipes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_recipe');
    }
}
