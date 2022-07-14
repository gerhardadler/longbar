<nav>
    <h1 class="nav-title"><a class="hover-link" href="/">Longbar.org</a></h1>
    <a class="hamburger"><img src="/img/hamburger.svg" alt=""></a>
    <ul class="navlinks">
        <li class="dropdown-container">
            <a class="hover-link" href="/guides">Guides</a>
            <div class="dropdown-guides">
                <div><a class="hover-link" href="/equipment">Equipment</a></div>
                <div><a class="hover-link" href="/history">History</a></div>
                <div><a class="hover-link" href="/new-player">New player</a></div>
                <div><a class="hover-link" href="/software">Software</a></div>
                <div><a class="hover-link" href="/strategy">Strategy</a></div>
                <div><a class="hover-link" href="/streaming">Streaming</a></div>
                <div><a class="hover-link" href="/tournaments">Tournaments</a></div>
            </div>
        </li>
        <li><a class="hover-link" href="/create-a-guide">Create a Guide</a></li>
        @auth
            <li>
                <a class="hover-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</nav>