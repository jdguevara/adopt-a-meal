@extends('layouts.app')

@section('scripts')
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
@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-2 calendar">
        <div id="calendar"></div>
            @foreach($events as $event)
                <div>{{$event->start->dateTime}}</div>
            @endforeach
        </div>

        <div>
            @foreach($events as $event)
                <div>{{$event->start->dateTime}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection


