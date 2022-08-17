<img class="img-fluid mx-auto d-block" src="{{ asset('img/logo.png') }}" style="width: auto" alt="logo">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Edaee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#edae_navbar"
            aria-controls="edae_navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="edae_navbar">
            <ul class="navbar-nav mr-auto">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if (Route::is('news.index')) active @endif">
                        <a class="nav-link" href="{{ route('news.index') }}">{{ __('news.title') }}</a>
                    </li>
                    <li class="nav-item @if (Route::is('recipes.index')) active @endif">
                        <a class="nav-link" href="{{ route('recipes.index') }}">{{ __('recipes.title') }}</a>
                    </li>
                    <li class="nav-item @if (Route::is('about')) active @endif">
                        <a class="nav-link" href="{{ route('about') }}">О нас</a>
                    </li>
                </ul>
            </ul>
            @if (!Route::is('search'))
                <form class="col-auto form-inline my-2 my-lg-0" method="post" action="{{ route('search') }}">
                    @csrf
                    <input class="form-control mr-sm-2" type="text" name="q" placeholder="{{ __('search.placeholder') }}"
                        aria-label="{{ __('search.title') }}">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i
                            class="fas fa-search"></i></button>
                </form>
            @endif
        </div>
        @guest
            <div>
                @if (!Route::is('login'))
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Войти</a>
                @endif
                @if (!Route::is('register'))
                    <a class="btn btn-outline-primary" href="{{ route('register') }}">Регистрация</a>
                @endif
            </div>
        @else
            @if (Auth::user()->hasRole('admin'))
                <a class="btn btn-outline-primary" href="{{ route('admin.index') }}"><i class="fas fa-tools"></i></a>
            @endif
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="user_bar" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="rounded" style="max-width: 35px; max-height: 35px"
                        src="{{ Auth::user()->avatar }}" alt="avatar"> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown07">
                    <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">Профиль</a>
                    {{-- <a class="dropdown-item" href="#">Сообщения(+1)</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Выход</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>
