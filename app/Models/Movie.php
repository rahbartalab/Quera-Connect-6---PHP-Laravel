<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $table = 'movies';

    public $timestamps = false;

    public function tickets(): HasMany
    {
        return $this->hasMany('App\Ticket');
    }
}
