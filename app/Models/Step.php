<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    /**
     * Returns the Recipe that has this Step.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */ 
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
