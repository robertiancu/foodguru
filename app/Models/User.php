<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Returns all the favourite recipes.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function favourites() {
        return $this->hasMany(Favourite::class);
    }

    /**
     * Returns all the cirles that this user belongs to.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function circles()
    {
        return $this->belongsToMany(Circles::class);
    }

    /**
     * Returns all the events that this user belongs to.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    /**
     * Returns all the ratings.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function ratings() {
        return $this->hasMany(Rating::class);
    }
}
