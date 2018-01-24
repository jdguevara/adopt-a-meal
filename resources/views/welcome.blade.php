@extends('layouts.app')

@section('scripts')
    <script>
      var events = {!! json_encode($events) !!};
      console.log(events);

      var encodedEvents = events.map(e => {
          return {
              "title": e.summary,
              "start": e.start.dateTime,
              "end": e.end.dateTime
          }
      });

      var eventClicked = function(calEvent, jsEvent, view) {
          
          var modal = $("#volunteer-modal").modal();
          modal.find('#title').text("Volunteer - " + calEvent.title);
          
        //   console.log("calEvent: ");
        //   console.log(calEvent);

        //   console.log("jsEvent: ");
        //   console.log(jsEvent);

        //   console.log("viewEvent: ");
        //   console.log(view);

        //   if(calEvent.start <= Date.now())
        //       return;
        //   alert('Event: ' + calEvent.title);
        //   //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
        //   //alert('View: ' + view.name);

        //   // change the border color just for fun
        //   $(this).css('border-color', 'red');
      };

      $('#volunteer-modal').on('show.bs.modal', function(event) {
        
      });
        
      $(document).ready(function() {
        $('#calendar').fullCalendar({
          events: encodedEvents,
          eventClick: eventClicked,
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

    <div class="modal fade" id="volunteer-modal" role="dialog">

        <div class="modal-dialog">

            {{--org name--}}
            {{--email--}}
            {{--phone number --}}
            {{--notes --}}
            {{--meal desc--}}
            {{--checkboxes--}}
            {{--event id (hidden)--}}

            <div class="modal-content">

                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;"></h3>
                </div>

                <div class="modal-body">

                    <p id="summary" class="volunteer-event-summary"></p>

                    <form id="event-form" class="volunteer-form" method="POST" action="/volunteer">

                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Organization Name</span>
                            <input id="organizationName" name="organizationName" type="text" class="form-control" placeholder="Organization Name">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Email</span>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Phone Number</span>
                            <input id="phoneNumber" name="phoneNumber" type="text" class="form-control" placeholder="Phone Number">
                        </div>

                        <div class="input-group">
                            <textarea id="notes" name="notes" type="text" class="form-control" placeholder="Notes"></textarea>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Meal Description</span>
                            <input id="mealDescription" name="mealDescription" type="text" class="form-control" placeholder="Meal Description">
                        </div>

                        <div id="eventId" name="eventId" class="hidden"></div>

                    </form>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Volunteer</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection


