<?php

namespace App\Models\Misc;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Event;

class EventRecipe extends Model
{
    protected $table = 'event_recipes';

    /**
     * Return the recipe associated with this instance.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Return the recipe that this event_recipe belongs to.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo(Event::class);
    }
}
