@extends('layouts.app')

@section('scripts')
@component('formmodals.volunteer-form-modaljs') @endcomponent
@component('formmodals.confirmed-event-modaljs') @endcomponent
<script>
var volunteerEvents = @json($volunteerEvents);
var acceptedEvents = @json($acceptedEvents);

var transformedVolunteerEvents = volunteerEvents.map(e => {
    return {
        "id": e.id,
        "title": e.summary,
        "start": e.start.date,
        "allDay": true,
        "color": "#36b0bF",
        "eventStatus": 0
    }
});
var transformedAcceptedEvents = acceptedEvents.map(e => {
    return {
        "id": e.id,
        "title": e.summary,
        "start": e.start.date,
        "allDay": true,
        "color": "#ef3c5a",
        "description": e.description,
        "eventStatus": 1
    }
});

var events = transformedVolunteerEvents.concat(transformedAcceptedEvents);

$(document).ready(function () {
    setupVolunteerFormValidation();
    /**
     * Load up a calendar event in the modal view so that a user can fill out their
     * info and submit it for review.
     * @param calEvent - the event data from Google Calendar API
     */
    var eventClicked = function (calEvent) {
        var today = moment().startOf('day');
        var eventDate = moment(calEvent.start).add(7, 'hours');

        // think of this operation like eventDate - today, negative is past, positive is future
        if(calEvent.eventStatus == 1){
            loadConfirmedEventModal(calEvent);
        } else if (eventDate.diff(today) < 0 && calEvent.eventStatus == 0) {
            $("#past-event-modal").modal();
        } else {
            loadVolunteerFormModal(calEvent);
        }
    };

    var eventRender = function(event, element){
        if(event.description == undefined) return;

        // Modifying the DOM containing the event to allow "tooltip"
        // Showing the description of an event when mouse hover it.
        element.attr("data-toggle","tooltip");
        element.attr("title", event.description );

        // Initialization of tooltip()
        $(function () { $('[data-toggle="tooltip"]').tooltip() });

        //Executing tooltip for each event.
        element.tooltip();
    };

    $('#listCalendar').fullCalendar({
        defaultView: 'listWeek',
        events: events,
        // Attaching a tooltip for each event showing the description when event is hover with mouse.
        eventRender: eventRender,
        // Action when an event is clicked
        eventClick: eventClicked,
        showNonCurrentDates: false,
        themeSystem: 'bootstrap3'
    });

    $('#calendar').fullCalendar({
        // List of events being showed in the calendar
        events: events,
        // Attaching a tooltip for each event showing the description when event is hover with mouse.
        eventRender: eventRender,
        // Action when an event is clicked
        eventClick: eventClicked,
        showNonCurrentDates: false,
        contentHeight: "auto",
        height: 'parent' + 80,
        aspectRatio: 1.5,
        themeSystem: 'bootstrap3'
    });
});
</script>

@endsection

@section('content')
    <div class="text-center jumbotron">
        <h1 id="jumbotron-header">{!! $messages['landing_page_title']  !!} </h1>
        <p> {{ $messages['volunteer_prompt'] }} </p>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-body calendar-panel text-center">
                    <div class="calendar">
                        <div id="calendar" class="desktop"></div>
                        <div id="listCalendar" class="mobile"></div>
                    </div>
                </div>
                <div class="panel-footer">
                    {!! $messages['volunteer_instructions'] !!}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center jumbotron jumbotron-footer">
        {!! $messages['volunteer_thank_you'] !!}
    </div>
    <!-- past event modal -->
    <div id="past-event-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;">This event is in the past</h3>
                </div>
                <div class="modal-body">
                    {!! $messages['event_taken'] !!}
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    @component('formmodals.confirmed-event-modal', [ 'messages' => $messages ]) @endcomponent
    @component('formmodals.volunteer-form-modal', [ 'messages' => $messages ]) @endcomponent
    </div>

@endsection


