<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container" id="app">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 text-center" style="padding-top:50px;">
                    <h1><strong>Openbare verkoop van kernwapens.</strong></h1>
                    <img class="img-rounded tw-shadow-md" style="margin-top:10px; margin-bottom: 20px;" src="http://via.placeholder.com/450x315">
                    <h1 style="margin-bottom: 20px;"><strong>Petitie</strong></h1>
                </div>

                <div class="col-md-offset-1 col-md-10 text-color">
                    <div class="panel panel-default tw-shadow-md">
                        <div class="panel-body">

                            <ul class="nav nav-tabs" role="tablist"> <!-- Tab menu -->
                                <li role="presentation" class="active"><a href="index.html">Uitleg</a></li>
                                <li role="presentation"><a href="ondersteund.html">Ondersteund door</a></li>
                                <li role="presentation"><a href="onderteken.html">Onderteken</a></li>
                                <li role="presentation"><a href="contact.html">Contact</a></li>
                                <li role="presentation"><a href="faq.html">FAQ</a></li>
                                <li role="presentation"><a href="disclaimer.html">Disclaimer</a></li>

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