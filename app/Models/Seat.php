<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    protected $table = 'seats';
    public $timestamps = false;

    public function tickets(): HasMany
    {
        return $this->hasMany('App\Ticket');
    }
}
