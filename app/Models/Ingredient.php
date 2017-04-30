<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\RecipesMeta;
use App\Models\Misc\IngredientMeta;

class Ingredient extends Model
{
    /**
     * Returns all RecipesMeta instances associated with this ingredient.
     * ! Created for using in this class only !
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function recipesMeta()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Returns all recipes that are made with this ingredient.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function recipes()
    {
        return $this->belongsToMany(RecipesMeta::class);
    }

    /**
     * Returns the meta information associated with this ingredient.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function meta()
    {
        return $this->hasMany(IngredientMeta::class);
    }
}
