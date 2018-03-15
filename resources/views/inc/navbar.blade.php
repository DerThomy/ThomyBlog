<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('services')}}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('posts.index')}}">Blog</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('home')}}">Dashboard</a>
                            
                                @auth('web')
                                <a class="dropdown-item" href="{{ route('users.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('User Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endauth
                                @auth('admin')
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('admin-logout-form').submit();">
                                    {{ __('Admin Logout') }}
                                </a>
                                <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endauth
                                @auth('superadmin')
                                <a class="dropdown-item" href="{{ route('superadmin.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('superadmin-logout-form').submit();">
                                    {{ __('Superadmin Logout') }}
                                </a>
                                <form id="superadmin-logout-form" action="{{ route('superadmin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endauth
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>