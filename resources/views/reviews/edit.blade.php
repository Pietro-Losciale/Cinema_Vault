<x-layout>

<div class="container mt-4">

    <h2 class="mb-4">Edit Review</h2>

    {{-- ERRORI VALIDAZIONE --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card bg-dark text-light">
        <div class="card-body">

            <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- VOTE --}}
                <div class="mb-3">
                    <label class="form-label">Vote</label>
                    <select name="vote" class="form-select">

                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}"
                                {{ $review->vote == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor

                    </select>
                </div>

                {{-- CONTENT --}}
                <div class="mb-3">
                    <label class="form-label">Your Review</label>
                    <textarea name="content" rows="5" class="form-control">{{ $review->content }}</textarea>
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-warning">
                    Update Review
                </button>

            </form>

        </div>
    </div>

</div>

</x-layout>