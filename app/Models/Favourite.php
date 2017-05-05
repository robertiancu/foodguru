<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    /**
     * Returns the Recipe that has been bookmarked.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */ 
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Returns the User that made this bookmark.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function user()
    {
        return $this->belongsTo(User:class);
    }
}
