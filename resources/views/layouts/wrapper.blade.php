<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100vh;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Bugfixed for Google Material Icons -->
        <style>
            /* Rules for sizing the icon. */
            .material-icons.md-18 { font-size: 18px; }
            .material-icons.md-24 { font-size: 24px; }
            .material-icons.md-36 { font-size: 36px; }
            .material-icons.md-48 { font-size: 48px; }

            /* Rules for using icons as black on a light background. */
            .material-icons.md-dark { color: rgba(0, 0, 0, 0.54); }
            .material-icons.md-dark.md-inactive { color: rgba(0, 0, 0, 0.26); }

            /* Rules for using icons as white on a dark background. */
            .material-icons.md-light { color: rgba(255, 255, 255, 1); }
            .material-icons.md-light.md-inactive { color: rgba(255, 255, 255, 0.3); }
        </style>

        <!-- Custom CSS stylesheets -->
        @stack('styles')

        
    </head>
    <body class="bg-transparent" style="min-height: 100vh;">

        <div id="app" class="bg-transparent" style="height: 100vh;" >
                @yield('app')
        </div>

        
        <!-- Bootstrap JS CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
