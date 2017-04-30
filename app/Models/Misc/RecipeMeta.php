<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Ingredient;

class RecipeMeta extends Model
{
    protected $table = 'recipe_meta';

    /**
     * Return the recipe associated with this instance.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Return the ingredient that belongs to this recipe.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
