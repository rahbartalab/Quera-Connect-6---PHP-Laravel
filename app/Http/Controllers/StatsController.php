<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeatResource;
use App\Models\Seat;

class StatsController extends Controller
{
    public function index()
    {
        return SeatResource::collection(Seat::query()->withCount('tickets')->get());
    }
}
