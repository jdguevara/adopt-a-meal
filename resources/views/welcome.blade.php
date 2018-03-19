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
        <h1 id="jumbotron-header">Adopt a Meal </h1>
        <p>Select a date to Adopt A Meal</p>
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
                    <h4>Instructions:</h4>
                    <ol>
                        <li>Click an open volunteer event in the Calendar above (Open events are blue).</li>
                        <li>Fill out the form that opens with a your organization's name or your name, contact information, and some information about the meal that will be provided. 
                            If you're unsure of the exact meal, please include that in the meal description and we will work with you!</li>
                        <li>Submit the form, and then you will recieve an e-mail confirmation.</li>
                        <li>Staff at Interfaith Sanctuary will contact you once they've been notified of your request.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center jumbotron jumbotron-footer">
        <h1 id="jumbotron-footer-header">Thank you for adopting a meal!</h1>
        <p>We would like to thank all the organizations who have volunteered for their wonderful contributions!</p>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group" >
                    @foreach(array_chunk($completedEvents, ceil(count($completedEvents)/2))[0] as $completeEvent)
                        <li class="list-group-item text-center text-capitalize thank-you-list-item" >
                            <h2>
                                {{$completeEvent->summary}}
                            </h2>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group thank-you-style" >
                    @foreach(array_chunk($completedEvents, ceil(count($completedEvents)/2))[1] as $completeEvent)
                        <li class="list-group-item thank-you-list-item" >
                            <h2>
                                {{$completeEvent->summary}}
                            </h2>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- past event modal -->
    <div id="past-event-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;">This event is in the past</h3>
                </div>
                <div class="modal-body">
                    Sorry, but this event has already happened. Please check some of the current events to adopt a
                    meal!
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    @component('formmodals.confirmed-event-modal', []) @endcomponent
    @component('formmodals.volunteer-form-modal', []) @endcomponent
    </div>

@endsection


