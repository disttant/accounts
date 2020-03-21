<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        
    </head>
    <body style="min-height: 100vh;">

        <div style="min-height: 100vh;" class="d-flex justify-content-center">
            <div class="d-flex align-items-center">
                <img src="{{ asset('img/512px.png') }}" style="height: 10rem; width: 10rem;">
            </div>
            <div class="d-flex align-items-center">
                <div class="d-flex flex-column mb-3">
                    <div class="p-2 border-bottom rounded-lg ">
                        <h1 class="display-4">@yield('code', __('Oh no'))</h1>
                        
                    </div>
                    <div class="p-2">
                        @yield('message')
                    </div>
                    <div class="p-2">
                        <a href="{{ app('router')->has('home') ? route('home') : url('/') }}">
                            <button type="button" class="btn btn-primary">
                                {{ __('Go Home') }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        




        
        
        

        
        @yield('image')

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
