<?php

namespace App\Http\Controllers;

use App\Seat;
use App\Movie;

class MovieController extends Controller
{
    public function list_movies()
    {
        $movies = Movie::all();
        return view('movies', ['movies'=>$movies]);
    }

    public function list_seats($id)
    {
        $seats = Seat::all();
        return view('seats', ['movie'=>$id, 'seats'=>$seats]);
    }

    public function reserve_seat($movie, $seat)
    {
        //
    }
}
