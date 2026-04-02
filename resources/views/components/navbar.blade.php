

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
  <div class="container-fluid">



    {{-- <a class="navbar-brand" href="{{ route('home') }}">Cinema Vault</a> --}}
    <a class="navbar-brand" href="{{ route('home') }}">
     <img src="/images/logo.png" alt="CinemaVault logo" >
    </a>




    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>


        {{-- AUTH DROPDOWN -snippet per Fortify--}}
  @auth
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          Hi, {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu">
          <li>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item">Logout</button>
              </form>
          </li>
      </ul>
  </li>
  @else
  <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
          Hi, Guest
      </a>
      <ul class="dropdown-menu">
          <li>
              <a class="dropdown-item" href="{{ route('login') }}">Login</a>
          </li>
          <li>
              <a class="dropdown-item" href="{{ route('register') }}">Register</a>
          </li>
      </ul>
  </li>
  @endauth


       

        <li class="nav-item dropdown d-flex align-items-center">

            <a class="nav-link" href="{{ route('genres') }}">
                Genres
            </a>

            <a class="nav-link dropdown-toggle dropdown-toggle-split"
              href="#"
              id="genresDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false">
            </a>

            <ul class="dropdown-menu" aria-labelledby="genresDropdown">

                @foreach ($genres as $genre)

                <li>
                    <a class="dropdown-item" href="{{ route('genre', $genre['id']) }}">
                        {{ $genre['name'] }}
                    </a>
                </li>

                @endforeach

            </ul>

        </li>
        
       
        





     
  




      
    </div>
        {{-- search bar funzionante --}}
                    <form class="d-flex " role="search" method="GET" action="{{ route('search') }}">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search a movie..." aria-label="Search"/>
                    <button class="btn btn-outline-dark btn-custom align-items-center d-flex" type="submit">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Search</button>
                    </form>

  </div>
</nav>