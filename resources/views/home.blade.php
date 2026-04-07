<x-layout>

<div class="container">

    <div class="row">
        <div class="col-12 text-center my-5">
            <h1>Home</h1>
        </div>
    </div>


        {{-- risultato query ricerca film  --}}

     @if(isset($query))
    <div class="row">
        <div class="col-12 mt-4 text-center">
            <h2>🔍 Results for "{{ $query }}"</h2>
        </div>
    </div>
    @endif








     @if(isset($genreName))
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <h2>🎬 {{ $genreName }} Movies</h2>
                </div>
            </div>
    @endif

    <div class="row">


        @foreach ($movies as $movie)
         <div class="col-md-3 mb-4">

            <div class="card h-100 d-flex flex-column">
                <a href="{{ route('movie.show', $movie['id']) }}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="card-img-top" alt="film poster">
                </a>
                
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $movie['title'] }}</h5>
            

                    <p class="card-text  mb-2" style="font-size: 0.9rem;">
                        Release: {{ \Carbon\Carbon::parse($movie['release_date'])->format('d M Y') }}
                    </p>

                   <p class="card-text mb-1">
                        ⭐ TMDB: {{ number_format($movie['vote_average'], 1) }}
                    </p>

                    @if($movie['cv_average'])
                        <p class="card-text text-warning mb-2">
                            🎬 CinemaVault: {{ number_format($movie['cv_average'], 1) }}
                        </p>
                    @else
                        <p class="card-text  mb-2">
                            🎬 CinemaVault: no reviews
                        </p>
                    @endif
                                        



                    <a href="{{ route('movie.show', $movie['id']) }}" class="btn btn-warning text-black mt-auto">Details</a>
                </div>
            </div>  
            
         </div>
        @endforeach


       

            

        

        

    </div>

</div>
    
</x-layout>