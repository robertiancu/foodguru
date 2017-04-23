<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Model;

class IngredientRecipe extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ingredient_recipe';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the primary_key is not incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates that this model has the
     * following composite primary key.
     *
     * $var array
     */
    protected $primaryKey = ['ingredient_id', 'recipe_id'];
}
