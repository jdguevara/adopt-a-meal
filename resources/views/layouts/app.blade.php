<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top" id="nav-shadow">
        <div class="navbar-header pull-left">
            <a class="navbar-brand"  id="navbar-brand-padding" href="{{url('http://interfaithsanctuary.org/')}}">
                <img class="brand" alt="Brand" id="navbar-brand-size" src="/images/Interfaith-Temp-Logo.png">
            </a>
            <a class="navbar-brand" id="navbar-brand-font" href="/">Adopt a Meal</a>
        </div>
        <button type="button" class="navbar-toggle collapsed pull-right" data-toggle="collapse" data-target="#navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse pull-right" id="navigation">
            <ul class="nav navbar-nav">
                @guest
                <li class="nav-item "><a class="navbar-link" href="/">Calendar View</a></li>
                <li class="nav-item "><a class="navbar-link" href="/meal-ideas">Meal Ideas</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Adopt-A-Meal Volunteers<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}">Volunteer Calendar</a></li>
                        <li><a href="{{ route('admin-home') }}">Review Pending Volunteers</a></li>
                        <li><a href="{{ route('admin-volunteerforms-table') }}">Past Volunteer Requests</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Meal Ideas<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('mealideas') }}">Public Meal Ideas</a></li>
                        <li><a href="{{ route('admin-mealideas') }}">Review Pending Meal Ideas</a></li>
                        <li><a href="{{ route('admin-mealideas-table') }}">Meal Ideas Table</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">Settings<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/admin/settings/change-messages">
                                Change Messages
                            </a>
                        </li>
                        <li><a href="/admin/settings/edit-forms">Edit Volunteer Forms</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    <div id="app">
        <div class="container" >
            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! implode('<br />', $errors->all()) !!}
                </div>
            @endif
            @include('flash::message')
        </div>
        <div class="fluid-container">
        @yield('content')
        </div>
    </div>
    {{--<div class="footer">--}}
        {{--<p>Created by: Boise State Merge Conflicts</p>--}}
    {{--</div>--}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <script>
      $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
      $('#flash-overlay-modal').modal();
    </script>
</body>
</html>
