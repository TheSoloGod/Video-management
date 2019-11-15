<nav class="navbar navbar-expand-lg navbar-light border rounded" style="background-color: #EEEEEE">
    <a class="navbar-brand" href="{{ route('home.new') }}">Video+</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home.public.index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('navbar.search') }}">
            <input class="form-control mr-sm-2" type="search" placeholder="Search video" aria-label="Search" name="key_word">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                @if (count(Auth::user()->unreadNotifications) == 0)
                <a class="nav-link" data-toggle="modal" data-target="#notificationModal">
                    <i class="far fa-bell"></i>
                    Notification
                </a>
                @else
                    <a class="nav-link" data-toggle="modal" data-target="#notificationModal">
                        <i class="far fa-bell"></i>
                        Notification <span class="badge badge-pill badge-primary">{{ count(Auth::user()->unreadNotifications) }}</span>
                    </a>
                    @endif
                @include('front_end.member.modal.notification')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        @if(Auth::user()->email_verified_at == null)
                            (not verify)
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->email_verified_at == null)
                            <a class="dropdown-item" href="{{ '/email/verify' }}">
                                Verify email
                            </a>
                            @else
                            <a class="dropdown-item" href="{{ route('member.info', Auth::user()->id) }}">
                                Profile
                            </a>
                        @endif

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
