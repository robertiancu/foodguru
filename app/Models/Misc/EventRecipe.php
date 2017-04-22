<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Event;

class EventRecipe extends Model
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
     * Return the recipe that this event_recipe belongs to.
     *
     * @return App\Models\Recipe
     */
    public function event() {
        return $this->belongsTo(Event::class);
    }
}
