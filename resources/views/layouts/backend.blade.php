<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if (auth()->check()) {{-- User is authenticated. --}}
                            <li @if (Request::is('users*')) class="active" @endif>
                                <a href="{{ route('users.index') }}">
                                    <i class="fa fa-users"></i> Login beheer
                                </a>
                            </li>

                            <li @if (Request::is('faq*')) class="active" @endif>
                                <a href="">
                                    <i class="fa fa-question-circle"></i> FAQ
                                </a>
                            </li>

                            <li @if (Request::is('contact*')) class="active" @endif>
                                <a href="">
                                    <i class="fa fa-envelope"></i> Contact
                                </a>
                            </li>

                            <li @if (Request::is('support*')) class="active" @endif>
                                <a href="">
                                    <i class="fa fa-list"></i> Organisaties
                                </a>
                            </li>

                            <li @if (Request::is('logs*')) class="active" @endif>
                                <a href="">
                                    <i class="fa fa-list"></i> Logs
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <i class="fa fa-home"></i> Stadsmonitor
                                </a>
                            </li>

                            <li>
                                <a href="">
                                    <i class="fa fa-newspaper-o"></i> Nieuws
                                </a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('account.settings', ['type' => 'information']) }}">
                                            <i class="fa fa-fw fa-cogs"></i> Account configuratie
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-fw fa-power-off"></i> Uitloggen
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
