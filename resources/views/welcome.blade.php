<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>Adopt-A-Meal</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.css' />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.7.0/fullcalendar.min.js'></script>
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
            <nav class="navbar top-menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-left" href="{{url('http://interfaithsanctuary.org/')}}">
                            <img class="brand" alt="Brand" src="images/Interfaith-Temp-Logo.png">
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
            <div class="container">
                <div class="col-md-10 col-md-offset-2 calendar">
                    <div id="calendar"></div>

                    <!-- @foreach($events as $event)

                        <div>{{$event->start->dateTime}}</div>


                    @endforeach -->
                </div>

            </nav>
            <div>
                @foreach($events as $event)

                    <div>{{$event->start->dateTime}}</div>


                @endforeach



            </div>


        </div>
        </body>
        <script>
            $(document).ready(function() {
                 // page is now ready, initialize the calendar...
                 
                $('#calendar').fullCalendar({
                    showNonCurrentDates: false,
                    contentHeight : "auto",
                    height: 'parent' +80 ,
                    aspectRatio: 1.5,
                    themeSystem: 'bootstrap3'
                // put your options and callbacks here
                });
            });
        </script>
</html>


