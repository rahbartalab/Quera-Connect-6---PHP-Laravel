<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function list_movies()
    {
        $movies = Movie::all();
        return view('movies', ['movies' => $movies]);
    }

    public function list_seats(Movie $movie)
    {
        $seats = Seat::query()->whereDoesntHave('tickets',
            fn(Builder $builder) => $builder->whereDoesntHave('movie',
                fn(Builder $builder) => $builder->where('id', '!=', $movie->id)
            )
        )->get();

        return view('seats', ['movie' => $movie, 'seats' => $seats]);
    }

    public function reserve_seat(Movie $movie,Seat $seat)
    {
        Ticket::query()->create([
            'seat_id' => $seat->id,
            'movie_id' => $movie->id,
            'user_id' => Auth::id() ,
            'date_bought' => now()
        ]);

        return redirect()->route('list_seats' , $movie);
    }
}
