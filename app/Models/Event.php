<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Misc\EventRecipe;
use App\Models\User;

class Event extends Model
{
    /**
     * Returns all EventRecipe instances associated with this event.
     * ! Created for using in this class only !
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function eventRecipe()
    {
        return $this->hasMany(EventRecipe::class);
    }

    /**
     * Returns all users that are in this event.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Returns all the recipes in this event
     * through EventRecipe.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function recipes() {
        return $this->event_recipe->map(function($event_recipe, $key) {
            return $event_recipe->recipe;
        });
    }
}
