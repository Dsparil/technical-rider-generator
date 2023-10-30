<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Simon PERRIN (https://github.com/Dsparil)" />
        <meta property="og:title" content="GTRG" />
        <meta property="og:description" content="Gevaudan's Technical Rider Generator" />
        <!-- <meta property="og:image" content="" /> -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url('/') }}" />
        <meta name="copyright" content="Simon PERRIN" />
        <meta name="robots" content="follow" />
        @yield('meta-description')

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <script type="text/javascript" src="{{ route('js-vars') }}"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/crudobject.js') }}"></script>
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container mainContainer">
            <div class="row">
                <div class="col">
                    <!-- <span class="flag-icon flag-icon-fr"></span> - 
                    <span class="flag-icon flag-icon-gb"></span> -->
                    <div class="row">
                        <div class="col s12 text-center">
                            <a href="{{ env('APP_URL') }}"><img class="header" src="{{ asset('images/logo-transparent.png') }}" /></a>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($page))
                @include('navbar', ['page' => $page])
            @endif
            @yield('content')
        </div>
    </body>
</html>
