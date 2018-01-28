@extends('layouts.app')

@section('scripts')
    <script>
      var volunteerEvents = {!! json_encode($volunteerEvents) !!};

      var acceptedEvents = {!! json_encode($acceptedEvents) !!};
      

      var transformedVolunteerEvents = volunteerEvents.map(e => {
          return {
              "title": e.summary,
              "start": e.start.dateTime,
              "end": e.end.dateTime,
              "color": "#36b0bF"
          }
      });


      var transformedAcceptedEvents = acceptedEvents.map(e => {
          return {
              "title": e.summary,
              "start": e.start.dateTime,
              "end": e.end.dateTime,
              "color": "green"
          }
      });

      var events = transformedVolunteerEvents.concat(transformedAcceptedEvents);
        
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          events: events,
          eventClick: function(calEvent, jsEvent, view) {
            if(calEvent.start <= Date.now())
                return;
            alert('Event: ' + calEvent.title);
            //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //alert('View: ' + view.name);

            // change the border color just for fun
            $(this).css('border-color', 'red');

            },
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
        <div class="panel-body calendar-panel text-center">
            <div class="calendar">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

</div>
@endsection


