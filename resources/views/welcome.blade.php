@extends('layouts.app')

@section('scripts')


    <script>

        var volunteerEvents = {!! json_encode($volunteerEvents) !!};
        var acceptedEvents = {!! json_encode($acceptedEvents) !!};


        var transformedVolunteerEvents = volunteerEvents.map(e => {
            console.log(e.end.date);
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
            /**
             * Load up a calendar event in the modal view so that a user can fill out their
             * info and submit it for review.
             * @param calEvent - the event data from Google Calendar API
             */
            var eventClicked = function (calEvent) {
                var today = moment().startOf('day');
                var eventDate = moment(calEvent.start);

                // think of this operation like eventDate - today, negative is past, positive is future
                if (eventDate.diff(today) < 0 && calEvent.eventStatus == 0) {
                    $("#past-event-modal").modal();
                }
                if(calEvent.eventStatus == 1){
                    $("#confirmed-event-modal").modal();
                    $("#confirmed-event-date").val(calEvent.start.format('MMMM Do YYYY'));
                    $("#confirmed-description").val(calEvent.description);
                    $("#confirmed-title").val(calEvent.title);
                }
                else {
                    // clear form fields from previous events
                    $("#volunteer-form").trigger("reset");

                    var eventTitle = (calEvent.title && calEvent.title.length > 0) ?
                        calEvent.title : "Volunteer For Event";

                    $('#title').text(eventTitle);
                    $('#event-id').val(calEvent.id);
                    $('#event-time').val(calEvent.start);
                    $('#event-date').val(calEvent.start.format('MMMM Do YYYY'));
                    $('#event-title').val(eventTitle);
                    $("#volunteer-modal").modal();
                }
            };
            
            var eventRender = function(event, element){
                if(event.description == undefined) return;
                
                // Modifying the DOM containing the event to allow "tooltip"
                // Showing the description of an event when mouse hover it.
                element.attr("data-toggle","tooltip");
                element.attr("title", "Description: " + event.description );

                // Initialization of tooltip()
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })

                //Executing tooltip for each event.
                element.tooltip();
            }

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

        /**
         * Submit the volunteer's info for reviewing
         */
        function submitVolunteerForm() {

            var $volunteerForm = $('#volunteer-form');

            // if the form isn't valid, "click" the submit button which will force html5 validation
            // else, send it!
            if(!$volunteerForm[0].checkValidity()) {
                $volunteerForm.find(':submit').click();
            } else {
                
                var bringingTableware = $("#paper-goods:checked").length;
                $("#paper-goods").val(bringingTableware);

                $("#inputs").hide();
                $("#loading-info").show();
                $volunteerForm.submit();

            }
        }
    </script>


@endsection

@section('content')
    <div class="text-center jumbotron">
        <h1 id="jumbotron-header">Adopt a Meal </h1>
        <h1 id="jumbotron-subheader">Calendar</h1>
        <p>Select a a date you would like to Adopt A Meal</p>
    </div>
    <div class="container">
        <div class="panel panel-default">
            {{--<div class="panel-heading text-center">--}}
                {{--<h1>Adopt-a-Meal Calendar</h1>--}}
                {{--<p>Select a a date you would like to Adopt A Meal</p>--}}
            {{--</div>--}}
            <div class="panel-body calendar-panel text-center">
                <div class="calendar">
                    <div id="calendar" class="desktop"></div>
                    <div id="listCalendar" class="mobile"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center jumbotron jumbotron-footer">
        <h1 id="jumbotron-footer-header">Thank you for adopting a meal!</h1>
        <p>We would like to thank all the organizations who adopted a meal for their wonderful contribution!</p>
    </div>

        <!-- past event modal -->
        <div id="past-event-modal" class="modal fade" role="dialog">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <h3 id="title" style="margin-top: 15px;">This event is in the past</h3>
                    </div>

                    <!-- list of text field inputs and check boxes  -->
                    <div class="modal-body">
                        Sorry, but this event has already happened. Please check some of the current events to adopt a
                        meal!
                    </div>

                    <div class="modal-footer"></div>
                </div>

            </div>

        </div>

        <!-- confirmed event modal -->
        <div id="confirmed-event-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="title" style="margin-top: 15px;">An organization has adopted this meal!</h3>
                    </div>  
                    <div class="modal-body">
                        <div id="inputs" class="volunteer-inputs">
                            <div class="input-group">
                                <span class="input-group-addon">Date</span>
                                <input id="confirmed-event-date" name="event_date" type="text"  
                                        class="form-control" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Title</span>
                                <input id="confirmed-title" name="title" type="text"
                                        class="form-control" placeholder="Title" disabled>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Description</span>
                                <input id="confirmed-description" name="description" type="text" class="form-control"
                                        placeholder="Description" disabled>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Volunteer form modal that is displayed when an event is clicked -->
        <form id="volunteer-form" class="volunteer-form" method="POST" action="/api/form/submit">
            <div class="modal fade" id="volunteer-modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 id="title" style="margin-top: 15px;">Adopt-A-Meal Form</h3>
                        </div>

                        <!-- list of text field inputs and check boxes  -->
                        <div class="modal-body">
                            <div id="inputs" class="volunteer-inputs">
                                <div class="input-group">
                                    <span><h5>
                                        Please provide the following information. Once the form is
                                        complete you will recieve a confirmation e-mail and we will
                                        contact you to help ensure your adopted meal will be a success!
                                    </h5></span>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Volunteer Date</span>
                                    <input id="event-date" name="event_date" type="text"  
                                           class="form-control" disabled>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Organization Name</span>
                                    <input id="organization_name" name="organization_name" type="text"
                                           class="form-control" placeholder="Organization Name" required>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Email</span>
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Email"
                                           required>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Phone Number</span>
                                    <input id="phone" name="phone" type="text" class="form-control"
                                           placeholder="Phone Number" required>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Meal Description</span>
                                    <input id="meal_description" name="meal_description" type="text" class="form-control"
                                           placeholder="Meal Description">
                                </div>
                                <div class="input-group">
                                    <textarea id="notes" name="notes" class="form-control"
                                              placeholder="Notes"></textarea>
                                </div>
                                <div class="input-group">
                                    <span>
                                        <strong>
                                        By clicking 'Volunteer' I acknowledge that I am volunteering 
                                        to be responsible for bringing at least 200 servings to the 
                                        Interfaith Sanctuary building by 5pm on the chosen date.
                                        </strong>
                                    </span>
                                    <div class="checkbox-group">
                                        <label class="checkbox"> I can provide paper goods
                                            <input id="paper-goods" name="paper_goods" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- rendered from event id stored in calendar -->
                                <input id="event-id" name="open_event_id" type="text" hidden />
                                <input id="event-time" name="open_event_date_time" type="text" hidden />
                                <input id="event-title" name="title" type="text" hidden />
                            </div>

                            <!-- loading spinner -->
                            <div id="loading-info" class="loading-info" hidden>
                                <h3 class="text-light text-center">Your volunteer information is being sent!</h3>
                                <div id="loading-spinner" class="spinner">
                                    <div class="dot1"></div>
                                    <div class="dot2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="input-group pull-right">
                                <button id="submit-form" type="button" class="btn btn-success"
                                        onClick="submitVolunteerForm();">Volunteer
                                </button>
                                <button id="cancel-form" type="button" class="btn btn-default" data-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" hidden></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection


