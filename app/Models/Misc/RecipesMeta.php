<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipesMeta extends Model
{
    /**
     * Return the recipe associated with this instance.
     *
     * @return App\Models\Recipe
     */
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Return the ingredient that belongs to this recipe.
     *
     * @return App\Models\Ingredient
     */
    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
