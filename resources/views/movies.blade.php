@foreach($movies as $movie)
    <a href="{{ route('list_seats' , $movie) }}"><h1>{{ $movie->title }}</h1></a>
@endforeach
