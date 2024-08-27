<a href="{{ route('list_movies') }}">movies</a>
<hr>
@foreach($seats as $seat)
    <a href="{{ route('reserve_seat' ,[$movie , $seat]) }}">
        <h1>reserve seat with {{ $seat->number }} number</h1>
    </a>
@endforeach
