<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container" id="app">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 text-center" style="padding-top:20px;">
                    <h1><strong>Openbare verkoop van kernwapens.</strong></h1>
                    <img class="img-rounded tw-shadow-md" style="width: 450px; height: 315px; margin-top:10px; margin-bottom: 20px;" src="{{ asset('img/ican.jpg') }}">
                    <h1 style="margin-bottom: 20px;"><strong>Petitie</strong></h1>
                </div>

                <div class="col-md-offset-1 col-md-10 text-color">
                    <div class="panel panel-default tw-shadow-md">
                        <div class="panel-body">

                            <ul class="nav nav-tabs" role="tablist"> <!-- Tab menu -->
                                <li role="presentation" @if (Request::is('/*')) class="active" @endif>
                                    <a href="{{ route('/') }}">Uitleg</a>
                                </li>
                                <li role="presentation" @if (Request::is('sign*')) class="active" @endif>
                                    <a href="{{ route('signature.create') }}">Onderteken</a>
                                </li>
                                <li role="presentation">
                                    <a href="">Nieuws</a>
                                </li>
                                <li role="presentation" @if (Request::is('support*')) class="active" @endif>
                                    <a href="{{ route('support.index') }}">Ondersteuning</a>
                                </li>
                                <li role="presentation" @if (Request::is('contact*')) class="active" @endif>
                                    <a href="{{ route('contact.index') }}">Contact</a>
                                </li>
                                <li role="presentation">
                                    <a href="faq.html">FAQ</a>
                                </li>
                                <li role="presentation" @if (Request::is('disclaimer*')) class="active" @endif>
                                    <a href="{{ route('disclaimer.index') }}">Disclaimer</a>
                                </li>

                                <li role="presentation">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                        Taal: <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="?lang=nl"><span class="flag-icon flag-icon-nl"></span> Nederlands</a></li>
                                        <li><a href="?lang=fr"><span class="flag-icon flag-icon-fr"></span> Frans</a></li>
                                        <li><a href="?lang=en"><span class="flag-icon flag-icon-us"></span> Engels</a></li>
                                    </ul>
                                </li>
                            </ul> <!-- /END Tab menu -->

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home" style="margin-top:10px;">
                                     @yield('content')
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

         {{-- Scripts --}}
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>