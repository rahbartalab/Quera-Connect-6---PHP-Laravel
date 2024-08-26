<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $table = 'tickets';
    public $timestamps = false;

    public function movie(): BelongsTo
    {
        return $this->belongsTo('App\Movie');
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo('App\Seat');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
