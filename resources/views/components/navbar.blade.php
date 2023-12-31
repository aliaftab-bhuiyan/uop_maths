<nav class="navbar bg-dark">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white mb-0 h1" href="/">MathxClub</a>
        <div class="d-flex">
        @if(Auth::guest())
            <a class="btn btn-success px-4" href="{{ route('signup') }}">Get Started</a>
        @else
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" width="40" height="40" class="rounded-circle" alt="">
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                    <li>
                        <strong><a class="dropdown-item fw-bold" href="#">@({{ Auth::user()->username }})</a></strong>
                    </li>
                    <li>
                        <strong><a class="dropdown-item" href="#">Notifications</a></strong>
                    </li>
                    <li>
                        <strong><a class="dropdown-item" href="#">Settings</a></strong>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input class="dropdown-item text-center text-danger" type="submit" value="Logout">
                        </form>
                    </li>
                </ul>
            </div>
        @endif
        </div>
    </div>
</nav>
