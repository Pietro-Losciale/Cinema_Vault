<footer class="footer-custom mt-5">

    <div class="container py-4">

        <div class="row align-items-center">

            {{-- LOGO / BRAND --}}
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <h5 class="mb-1">🎬 CinemaVault</h5>
                <small>Discover, rate and save your favorite movies</small>
            </div>

            {{-- LINK --}}
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <a href="{{ route('home') }}" class="footer-link">Home</a>
                <a href="{{ route('genres') }}" class="footer-link">Genres</a>

                @auth
                    <a href="{{ route('reviews.my') }}" class="footer-link">My Reviews</a>
                @endauth
            </div>

            {{-- SOCIAL --}}
            <div class="col-md-4 text-center text-md-end">
                <a href="#" class="footer-icon"><i class="fab fa-github"></i></a>
                <a href="#" class="footer-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="footer-icon"><i class="fab fa-twitter"></i></a>
            </div>

        </div>

    </div>

    <div class="text-center py-2 footer-bottom">
        © {{ date('Y') }} CinemaVault — All rights reserved
    </div>

</footer>