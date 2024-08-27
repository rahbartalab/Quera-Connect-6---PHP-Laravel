<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $id
 */
class Movie extends Model
{
    protected $fillable = [
        'title' ,
        'release_year' ,
        'play_time'
    ];

    protected $table = 'movies';

    public $timestamps = false;

    public function tickets(): HasMany
    {
        return $this->hasMany('App\Ticket');
    }
}
