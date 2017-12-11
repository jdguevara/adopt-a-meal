<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Template</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="email-template">
    <!--<div class="container">
        <div class="jumbotron email-logo-container">
            <h1>
                <a class="email-logo" href="{{url('http://interfaithsanctuary.org/')}}">
                    <img class="" src="images/Interfaith-Temp-Logo.png">
                </a>
                Adopt-A-Meal Program
            </h1>
        </div>
    </div>-->
    <div class="container">
        <div class="page-header email-logo-container">
            <h1>
                <a class="email-logo" href="{{url('http://interfaithsanctuary.org/')}}">
                    <img class="img-responsive" src="images/Interfaith-Temp-Logo.png">
                </a>
                Adopt-A-Meal Program
            </h1>
        </div>
    </div>
    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
