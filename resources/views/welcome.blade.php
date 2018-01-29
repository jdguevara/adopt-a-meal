@extends('layouts.app')

@section('scripts')
    <script>

        
        var events = {!! json_encode($events) !!};
        var encodedEvents = events.map(e => {
            return {
                "id": e.id,
                "title": e.summary,
                "start": e.start.dateTime,
                "end": e.end.dateTime
            }
        });



        /**
         * Load up a calendar event in the modal view so that a user can fill out their
         * info and submit it for review.
         * @param calEvent - the event data from Google Calendar API
         */
        var eventClicked = function (calEvent) {

            var today = moment().startOf('day');
            var eventDate = moment(calEvent.start);

            // think of this operation like eventDate - today, negative is past, positive is future
            if(eventDate.diff(today) < 0) {
                $("#past-event-modal").modal();
            }
            else {
                // clear form fields from previous events
                $("#volunteer-form").trigger("reset");

                var eventTitle = (calEvent.title && calEvent.title.length > 0) ?
                    calEvent.title : "Volunteer For Event";

                var modal = $("#volunteer-modal").modal();
                modal.find('#title').text(eventTitle);
                modal.find('#event-id').val(calEvent.id);
            }
        };

        /**
         * Load the calendar with events from server
         */
        $(document).ready(function () {
            $('#calendar').fullCalendar({
                events: encodedEvents,
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
            if (!$volunteerForm[0].checkValidity() || !validateVolunteerForm()) {
                $volunteerForm.find(':submit').click();
            } else {

                var bringingFood = !!$("#food:checked").length;
                $("#food").val(bringingFood);

                var bringingUtensils = !!$("#utensils:checked").length;
                $("#utensils").val(bringingUtensils);

                $("#inputs").hide();
                $("#loading-info").show();
                $volunteerForm.submit();

            }
        }



        /**
         * Everytime the bringing food confirmation is clicked, make sure that the
         * submit button is appropriately disabled
         * @returns {boolean}
         */
        function validateVolunteerForm() {
            var bringingFood = !!$("#food:checked").length;
            $("#submit-form").prop('disabled', !bringingFood);
            return bringingFood;
        }

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

        <!-- past event modal -->
        <div id="past-event-modal" class="modal fade" role="dialog">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">
                        <h3 id="title" style="margin-top: 15px;">This event is in the past</h3>
                    </div>

                    <!-- list of text field inputs and check boxes  -->
                    <div class="modal-body">
                        Sorry, but this event has already happened. Please check some of the current events to adopt a meal!
                    </div>

                    <div class="modal-footer"></div>
                </div>

            </div>

            </div>


        <!-- Volunteer form modal that is displayed when an event is clicked -->
        <form id="volunteer-form" class="volunteer-form" method="POST" action="/api/form/submit">

            <div class="modal fade" id="volunteer-modal" role="dialog">

                <div class="modal-dialog">

                    <div class="modal-content">


                        <div class="modal-header">
                            <h3 id="title" style="margin-top: 15px;"></h3>
                        </div>


                        <!-- list of text field inputs and check boxes  -->
                        <div class="modal-body">

                            <div id="inputs" class="volunteer-inputs">

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Organization Name</span>
                                    <input id="organizationName" name="organizationName" type="text"
                                           class="form-control" placeholder="Organization Name" required>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Email</span>
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Email"
                                           required>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Phone Number</span>
                                    <input id="phoneNumber" name="phoneNumber" type="text" class="form-control"
                                           placeholder="Phone Number" required>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Meal Description</span>
                                    <input id="mealDescription" name="mealDescription" type="text" class="form-control"
                                           placeholder="Meal Description">
                                </div>

                                <div class="input-group">
                                    <textarea id="notes" name="notes" class="form-control"
                                              placeholder="Notes"></textarea>
                                </div>

                                <div class="input-group">
                                    <span>I will provide: </span>
                                    <div class="checkbox-group">
                                        <label class="checkbox" style="margin-right: 15px;"> Food <span
                                                    class="text-light"> (required) </span>
                                            <input id="food" name="bringingFood" type="checkbox"
                                                   onClick="validateVolunteerForm();">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="checkbox"> Utensils
                                            <input id="utensils" name="bringingUtensils" type="checkbox"
                                                   onClick="validateVolunteerForm();">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- rendered from event id stored in calendar -->
                                <input id="event-id" name="eventId" type="text" hidden></input>
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
                                        onClick="submitVolunteerForm();" disabled>Volunteer
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


