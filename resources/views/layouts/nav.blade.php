<nav>
    <h1 class="nav-title"><a class="hover-link" href="/">Longbar.org</a></h1>
    <a class="hamburger"><img src="/img/hamburger.svg" alt=""></a>
    <ul class="navlinks">
        <li class="dropdown-container">
            <a class="hover-link" href="/guides">Guides</a>
            <div class="dropdown">
                <div><a class="hover-link" href="/equipment">Equipment</a></div>
                <div><a class="hover-link" href="/history">History</a></div>
                <div><a class="hover-link" href="/new-player">New player</a></div>
                <div><a class="hover-link" href="/software">Software</a></div>
                <div><a class="hover-link" href="/strategy">Strategy</a></div>
                <div><a class="hover-link" href="/streaming">Streaming</a></div>
                <div><a class="hover-link" href="/tournaments">Tournaments</a></div>
            </div>
        </li>
        <li><a class="hover-link" href="/guides/create">Create a Guide</a></li>
        @auth
            <li class="dropdown-container" style="position: static;">
                <a class="hover-link" href="/my-guides">User</a>
                <div class="dropdown dropdown-hug-right">
                    <div><a class="hover-link" href="/my-guides">My Guides</a></div>
                    <div><a class="hover-link" href="/password/reset">Reset Password</a></div>
                    <div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="hover-link">Logout</button>
                        </form>
                    </div>
                </div>
            </li>
        @else
            <li>
                <a href="{{ route("login") }}" class="hover-link">
                    Login
                </a>
            </li>
        @endauth
    </ul>
</nav>