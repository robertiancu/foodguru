<?php

namespace App\Models\Pivots;

use Illuminate\Database\Eloquent\Model;

class CircleUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'circle_user';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the primary key is incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates that this model has the following
     * composite primary key.
     *
     * @var array
     */
    protected $primaryKey = ['circle_id','user_id'];
}
