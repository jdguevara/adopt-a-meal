<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<<<<<<< HEAD
        <title>Laravel</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
=======
        <title>Adopt-A-Meal</title>
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
>>>>>>> master
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
<<<<<<< HEAD
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{url('http://interfaithsanctuary.org/')}}">
                            {{--<img alt="Brand" src="...">--}}
                            <div>Logo</div>
=======
            <nav class="navbar top-menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-left" href="{{url('http://interfaithsanctuary.org/')}}">
                            <img class="brand" alt="Brand" src="images/Interfaith-Temp-Logo.png">
>>>>>>> master
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
<<<<<<< HEAD

=======

                </div>

            </nav>
            <div class="container">
                <div class="col-md-8 col-md-offset-2 calender">
                    Place Calender Here
                    @foreach($events as $event)

                        <div>{{$event->start->dateTime}}</div>


                    @endforeach
>>>>>>> master
                </div>

            </nav>
            <div>
                @foreach($events as $event)

                    <div>{{$event->start->dateTime}}</div>


                @endforeach



            </div>


        </div>
        </body>
</html>


