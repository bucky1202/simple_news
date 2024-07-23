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
                        <a class="nav-link" href="{{ route('editor.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news.index') }}">News</a>
                    </li>

                </ul>
                <ul class="navbar-nav">

                    @auth
                        <a href="{{ route('profile.index') }}" style="margin-top: 8px">{{ Auth::user()->username }}</a>
                        <form method="POST" action="{{ route('editor.auth.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Logout</button>
                        </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
