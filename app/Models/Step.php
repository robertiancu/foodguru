<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
