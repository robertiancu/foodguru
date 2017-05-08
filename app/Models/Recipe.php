<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function steps()
    {
    	return $this->hasMany('App\Models\Step');
    }
    public function ratings()
    {
    	return $this->hasMany('App\Models\Rating');
    }
    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }
    public function ingredients()
    {
    	return $this->belongsToMany('App\Ingredient');
    }
    public function events()
    {
    	return $this->belongsToMany('App\Event');
    }

    /**
     * Laravel scope for returning recent recipies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMostRecent($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    /**
     * Laravel scope for returning recent recipies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBestRatings($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
