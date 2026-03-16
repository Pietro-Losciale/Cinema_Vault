<x-layout>

    <div class="container" mt-5 mb-5>

        <h1>Genres</h1>

            <ul class="list-group mt-4">

                @foreach($genres as $genre)

                    <li class="list-group-item">
                        <a href="{{ route('genre', $genre['id']) }}">
                            {{ $genre['name'] }}
                        </a>
                    </li>

                @endforeach

            </ul>



    </div>
</x-layout>