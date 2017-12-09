@extends('layouts.app')

@section('scripts')
    <script>
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          showNonCurrentDates: false,
          contentHeight : "auto",
          height: 'parent' +80 ,
          aspectRatio: 1.5,
          themeSystem: 'bootstrap3'
        });
      });
    </script>

@endsection

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h3>Adopt-a-Meal Calendar</h3>
            <p>Select a meal you would like to adopt.</p>
        </div>
        <div class="panel-body text-center">
            <div class="calendar">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

</div>
@endsection


