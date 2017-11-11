<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    </head>

        <body>
        <div class="">
            {{--@if (Route::has('login'))--}}
            {{--<div class="top-right links">--}}
            {{--@auth--}}
            {{--<a href="{{ url('/home') }}">Home</a>--}}
            {{--@else--}}
            {{--<a href="{{ route('login') }}">Login</a>--}}
            {{--<a href="{{ route('register') }}">Register</a>--}}
            {{--@endauth--}}
            {{--</div>--}}
            {{--@endif--}}
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{url('http://interfaithsanctuary.org/')}}">
                            {{--<img alt="Brand" src="...">--}}
                            <div>Logo</div>
                        </a>


                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                        <ul class="nav navbar-nav navbar-center">

                            <li><a class="navbar-brand" href="#">Adopt-a-Meal</a></li>

                        </ul>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">

                            <li><a href="#">Calendar View</a></li>

                            <li><a href="#">Meal Ideas</a></li>

                        </ul>

                    </div><!-- /.navbar-collapse -->

                </div>

            </nav>


        </div>
        </body>
</html>


