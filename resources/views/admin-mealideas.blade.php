@extends('layouts.app')

@section('scripts')
    <script>

        var mealIdeas = {!! json_encode($mealideas) !!};

        function viewEvent (eventId) {
            // find the event in our events list
            var event = mealIdeas.find(function(event) { return mealIdeas.id === eventId; });

            // open the modal with event info
            $("#title").text(event.title);
            $('#meal-description').val(event.meal_description);
            $('#organization-name').val(event.organization_name);
            $('#event-date-time').val(event.event_date_time);
            $('#email').val(event.email);
            $('#notes').val(event.notes);
            $('#phone').val(event.phone);
            $('#paper-goods').val(event.paper_goods == 1 ? "Yes" : "No");
            $('#open-event-id').val(event.open_event_id);
            $('#volunteer-id').val(event.id);
            $("#event-modal").modal();
        }

        function submitEvent (approval) {
            // send the form, value set in jquery is async apparently?
            $('#approve-event').val(approval);
            $('#event-form').submit();
        }
    </script>
@endsection


@section('content')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center text-capitalize"><h3>Review Meal Ideas</h3></div>

                    <div class="panel-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        Accept, Edit and Delete Meal Ideas here.
                    </div>

                </div>

                <form id="event-form" method="POST" action="/admin/meal-ideas/review">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal fade" id="event-modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 id="title" style="margin-top: 15px;"></h3>
                                </div>
                                <!-- list of text field inputs and check boxes  -->
                                <div class="modal-body event-info">

                                    <div class="input-group">
                                        <span class="input-group-addon">Meal Description</span>
                                        <input id="meal-description" class="form-control" disabled />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Organization Name</span>
                                        <input id="organization-name" class="form-control" disabled />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Date</span>
                                        <input id="event-date-time" class="form-control" disabled />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Email</span>
                                        <input id="email" class="form-control" disabled />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Phone</span>
                                        <input id="phone" class="form-control" disabled />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Notes</span>
                                        <input id="notes" class="form-control" disabled />
                                    </div>


                                    <div class="input-group">
                                        <span class="input-group-addon">Paper Goods</span>
                                        <input id="paper-goods" class="form-control" disabled />
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <div class="input-group pull-right">

                                        <button id="approve"
                                                type="button"
                                                class="btn btn-success"
                                                onClick="submitEvent(1);">
                                            Approve
                                        </button>

                                        <button id="deny"
                                                type="button"
                                                class="btn btn-warning"
                                                onClick="submitEvent(0);">
                                            Deny
                                        </button> 
                                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                        <input type="text" id="open-event-id" name="open_event_id" hidden>
                                        <input type="text" id="volunteer-id" name="volunteer_id" hidden>
                                        <input type="text" id="approve-event" name="approve_event" hidden>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

                @foreach($mealideas as $mealidea)
                    <ul class="list-group">
                        <li class="list-group-item ">
                            <h5>{{$mealidea->title}}</h5>
                            <h6>From: {{$mealidea->name}}</h6>
                            <button id="view-event" onclick="viewEvent('{{$mealidea['id']}}');" class="btn btn-warning event-info-details pull-right">
                                Details
                            </button>
                        </li>
                    </ul>

                @endforeach
            </div>


        </div>

@endsection
