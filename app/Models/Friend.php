<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
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
    protected $primaryKey = ['user_id', 'friend_id'];
}
