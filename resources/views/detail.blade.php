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

            <p class="mt-2">
            @foreach($movie['genres'] as $genre)
                <span class="badge bg-warning text-black me-1">
                    {{ $genre['name'] }}
                </span>
            @endforeach
           </p>

            <p class="mt-3">
                {{ $movie['overview'] }}
            </p>

            <p>
                Release date: {{ $movie['release_date'] }}
            </p>

            {{-- snippet --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- REVIEWS --}}
            <div class="mt-5 p-4 rounded" style="background-color: rgba(0,0,0,0.6);">

                @auth

                    @if(!$userReview)

                        <h4 class="text-white">Write a review</h4>

                        <form method="POST" action="{{ route('reviews.store') }}">
                            @csrf

                            <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">

                            <div class="mb-3">
                                <label class="text-white">Vote</label>

                                <select name="vote" class="form-control" required>
                                    <option value="">Select a vote</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}/10</option>

                                        @if($i < 10)
                                            <option value="{{ $i }}.5">{{ $i }}.5/10</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="text-white">Review</label>
                                <textarea name="content" class="form-control" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-warning">Submit</button>
                        </form>

                    @else

                        <div class="alert alert-info">
                            You already wrote a review for this movie.
                        </div>

                    @endif

                @else

                    <div class="alert alert-warning">
                        You must be logged in to write a review.
                    </div>

                @endauth

                <hr class="text-white">

                <h4 class="text-white">Reviews</h4>

                @isset($reviews)
                    @forelse($reviews as $review)
                        <div class="mb-3 p-3 rounded bg-dark text-white">
                            <strong>{{ $review->user->name }}</strong>
                            <span class="badge bg-warning text-black ms-2">
                                {{ $review->vote }}/10
                            </span>

                            <p class="mt-2 mb-0">
                                {{ $review->content }}
                            </p>

                            @auth
                                @if($review->user_id === auth()->id())
                                    <form method="POST" action="{{ route('reviews.destroy', $review) }}" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    @empty
                        <p class="text-white">No reviews yet.</p>
                    @endforelse
                @endisset

            </div>

        </div>

    </div>

</div>

</x-layout>