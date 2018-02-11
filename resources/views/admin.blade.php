@extends('layouts.app')

@section('scripts')
    <script>

        $(document).ready(function(){


            var volunteerEvents = {!! json_encode($volunteerForms) !!};


            {{--<span id="meal-description">{{ $form['meal_description'] }}</span>--}}
            {{--<span id="organization-name">{{ $form['organization_name'] }}</span>--}}
            {{--<span id="event_date_time">{{ $form['event_date_time'] }}</span>--}}
            {{--<span id="email">{{ $form['email'] }}</span>--}}
            {{--<span id="notes">{{ $form['notes'] }}</span>--}}
            {{--<span id="phone">{{ $form['phone'] }}</span>--}}
            {{--<span id="paper_goods">{{ $form['paper_goods'] }}</span>--}}

            $('#myModal').on('show.bs.modal',function(event) {
                console.log(event.relatedTarget);
                var button = $(event.relatedTarget);
                var notes = button.data('notes');
                console.log(button);
                console.log(notes);

                var mealDescription = button.data('mealdescription');
                var organization = button.data('organization');
                var email = button.data('email');
                var notes = button.data('notes');
                var phone = button.data('phone');
                var date = button.data('date');

                var tablewareConfirmation = button.data('tablewareconfirmation');
                console.log('test tableware:', tablewareConfirmation);
                var bringtableware = "They will provide the tableware"

                var modal = $(this)
                modal.find('.organization').text(organization)
                if(email)
                    modal.find('.email').text("Email: " + email)
                if(phone)
                    modal.find('.phone').text("Phone: "+ phone)
                if(mealDescription)
                    modal.find('.mealdescription').text("Meal Description: " + mealDescription)
                modal.find('.modal-title').text("Adopt-a-Meal request for: "+ date)
                if(notes)
                    modal.find('.notes').text("Notes: "+ notes)
                if(tablewareConfirmation == '1')
                    modal.find('.tablewareconfirmation').text("Other Details: They are planning to provide tableware")
            })

        });


    function viewEvent(eventId) {
        console.log(eventId);
    }

    </script>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center text-capitalize"><h3>Admin Dashboard</h3></div>

                    <div class="panel-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                        Accept, Edit and Delete Adopt-a-Meal requests here.
                    </div>

                </div>

                <form id="volunteer-info-form" class="volunteer-info-form" method="POST" action="/api/admin/submit">

                    <div class="modal fade" id="volunteer-info-modal" role="dialog">

                        <div class="modal-dialog">

                            <div class="modal-content">


                                <div class="modal-header">
                                    <h3 id="title" style="margin-top: 15px;"></h3>
                                </div>


                                <!-- list of text field inputs and check boxes  -->
                                <div class="modal-body">
                                    <div id="volunteer-information" class="volunteer-info"></div>
                                </div>


                                <div class="modal-footer">

                                    <div class="input-group pull-right">

                                        <button id="submit-form"
                                                type="button"
                                                class="btn btn-success"
                                                onClick="approveVolunteer();">
                                            Approve
                                        </button>

                                        <button id="deny-form"
                                                type="button"
                                                class="btn btn-default"
                                                onClick="denyVolunteer();">
                                            Deny
                                        </button>

                                        <input type="number" id="approve-volunteer" name="approve_volunteer" hidden>
                                        <button type="submit" hidden></button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

                @foreach($volunteerForms as $form)
                    <ul class="list-group">

                        <li class="list-group-item "><div class="row">

                                <div class= "col-sm-8">
                                    <h5>Adopt-a-Meal Request for: {{$form->event_date_time}}</h5>
                                    <h6>From: {{$form->organization_name}}</h6>
                                </div>

                                <div class="col-sm-4">
                                    <button id="view-event" onclick="viewEvent('{{$form['open_event_id']}}');"> Details </button>
                                </div>

                            </div>
                        </li>
                    </ul>

                @endforeach
            </div>


        </div>
    </div>
@endsection
