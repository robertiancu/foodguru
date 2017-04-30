<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;

class IngredientMeta extends Model
{
    protected $table = 'ingredient_meta';

    /**
     * Returns the ingredient associated with this meta.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
