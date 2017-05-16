<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Event;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'admin',
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
     * Returns all the friends of this user.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function friends() {
        return $this->hasMany(Friend::class);
    }

    /**
     * Returns all the friend requests for this user.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function friendRequestsRecived() {
        return $this->hasMany(FriendRequest::class, 'new_friend_id', 'id');
    }

    /**
     * Returns all the friend requests created by this user.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function friendRequestsGiven() {
        return $this->hasMany(FriendRequest::class, 'user_id', 'id');
    }

    /**
     * Returns all the cirles that this user belongs to.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function circles()
    {
        return $this->belongsToMany(Circle::class);
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

    /**
     * Return route to profile image or image from give url.
     *
     * @return void
     */
    public function profileImageRoute()
    {
        $profile_image = $this->image;
        if ($profile_image == null) {
            return '/image/user/default';
        } else {
            return '/image/user/' . (string) $this->id;
        }
    }
}
