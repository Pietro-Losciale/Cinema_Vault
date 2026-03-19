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

            <div class="card h-100">
                <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="card-img-top" alt="film poster">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $movie['title'] }}</h5>
                    <p class="card-text">{{ $movie['release_date'] }}</p>
                    <p class="card-text">⭐ {{ $movie['vote_average'] }}</p>
                    <a href="/movie/{{ $movie['id'] }}" class="btn btn-warning text-black">Details</a>
                </div>
            </div>  
            
         </div>
        @endforeach


       

            

        

        

    </div>

</div>
    
</x-layout>