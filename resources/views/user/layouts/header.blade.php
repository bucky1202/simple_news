<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news.index') }}">All news</a>
                    </li>

                </ul>
                <ul class="navbar-nav">

                    @auth

                        <a href="{{ route('profile.index') }}" style="margin-top: 8px">{{ Auth::user()->username }}</a>
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    @endauth
                    @guest
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                    </li>
                    @endguest


                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif --}}
                    {{-- @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest --}}
                </ul>
            </div>
        </div>
    </nav>
</header>
