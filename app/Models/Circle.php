<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    /**
     * Returns all Users that are members of this Circle.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Returns the owner User of this Circle.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
