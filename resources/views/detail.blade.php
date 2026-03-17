<x-layout>

<div class="container mb-5 mt-5">

    <div class="row">

       {{-- POSTER --}}
        <div class="col-md-4">
            <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="img-fluid">
        </div>

        {{-- TESTI --}}
        <div class="col-md-8">

            <h1>{{ $movie['title'] }}</h1>



            {{-- //generi// --> span invece di div consente di mettere le etichette una accanto all'altra.--}}


            <p class="mt-2">
            @foreach($movie['genres'] as $genre)
                <span class="badge bg-warning text-black me-1">
                    {{ $genre['name'] }}
                </span>
            @endforeach
           </p>

           {{-- // --}}

            <p class="mt-3">
                {{ $movie['overview'] }}
            </p>

            <p>
                Release date: {{ $movie['release_date'] }}
            </p>

        </div>

    </div>

</div>

</x-layout>