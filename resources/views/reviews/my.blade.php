<x-layout>


    {{-- snippet di eliminazione avvenuta con successo --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container mt-4">

    <h2 class="mb-4">My Reviews</h2>

    @if($reviews->isEmpty())
        <div class="alert alert-info">
            You haven't written any reviews yet.
        </div>
    @else

        @foreach($reviews as $review)
            <div class="card mb-4 bg-dark text-light shadow-sm">
                <div class="card-body">

                    <div class="d-flex align-items-start">

                        {{-- Poster --}}
                        @if($review->poster_path)
                            <img src="https://image.tmdb.org/t/p/w200{{ $review->poster_path }}" 
                                 alt="{{ $review->movie_title }}" 
                                 class="me-3"
                                 style="width: 90px; border-radius: 6px;">
                        @endif

                        {{-- Info --}}
                        <div class="flex-grow-1">

                            <h5 class="mb-2 fw-bold">
                                {{-- {{ $review->movie_title }} --}}
                                <a href="{{ route('movie.show', $review->movie_id) }}" class="text-light text-decoration-none">
                                    {{ $review->movie_title }}
                                </a>
                            </h5>

                            <p class="mb-2 text-warning">
                                <strong>Vote:</strong> {{ $review->vote }}
                            </p>

                            {{-- REVIEW TEXT --}}
                            <div x-data="{ open: false }">

                                <p style="max-width: 700px; line-height: 1.6;">

                                    <span x-show="!open">
                                        {{ \Illuminate\Support\Str::limit($review->content, 180) }}
                                    </span>

                                    <span x-show="open">
                                        {{ $review->content }}
                                    </span>

                                </p>

                                @if(strlen($review->content) > 180)
                                    <button 
                                        @click="open = !open"
                                        class="btn btn-sm btn-outline-light mt-2"
                                    >
                                        <span x-show="!open">Show more</span>
                                        <span x-show="open">Show less</span>
                                    </button>
                                @endif

                            </div>


                             {{-- TASTO DELETE E EDIT--}}

                    <div class="mt-3 d-flex gap-2">

                        {{-- EDIT --}}
                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>

                    </div>

                        </div>

                    </div>

                </div>
            </div>
        @endforeach

    @endif

   

</div>

</x-layout>