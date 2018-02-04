@extends('layouts.app')

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
                        <a href="/testEmail">Click here to send a test email</a>
                        Accept, Edit and Delete Adopt-a-Meal requests here.
                    </div>

                </div>

                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <h5 class="organization"></h5>
                                <hr/>
                                <p class="email"></p>
                                <p class ="phone"></p>
                                <p class="mealdescription"></p>
                                <hr/>
                                <p class ="notes"></p>
                                <p class ="tablewareconfirmation"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info pull-left" v-if="" data-dismiss="modal">Accept</button>
                                <button type="button" class="btn btn-danger pull-left" v-if="" data-dismiss="modal">Decline</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>

                @foreach($forms as $form)
                    <ul  class="list-group">
                        <li class="list-group-item "><div class="row">
                                <div class= "col-sm-8">
                                    <h5>Adopt-a-Meal Request for: {{$form->event_date_time}}</h5>
                                    <h6>From: {{$form->organization_name}}</h6>
                                </div>


                                <div class="btn-toolbar col-sm-4">
                                    {{--<button type="button" class="btn btn-danger pull-right "  >Decline</button>--}}
                                    <button type="button" class="btn btn-warning pull-right" data-toggle="modal"
                                            :data-mealdescription="{{json_encode($form['meal_description'],true)}}"
                                            :data-organization="{{json_encode($form['organization_name'],true)}}"
                                            :data-date="{{json_encode($form['event_date_time'],true)}}"
                                            :data-email="{{json_encode($form['email'],true)}}"
                                            :data-notes="{{json_encode($form['notes'],true)}}"
                                            :data-tablewareconfirmation="{{json_encode($form['tableware_confirmation'],true)}}"
                                            :data-phone="{{json_encode($form['phone'],true)}}"
                                            data-target="#myModal">Details</button>
                                    {{--<button type="button" class="btn btn-info pull-right" >Accept</button>--}}

                                </div>
                            </div>
                        </li>
                    </ul>

                @endforeach
            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#myModal').on('show.bs.modal',function(event) {
                var button = $(event.relatedTarget)
                var mealDescription = button.data('mealdescription')
                var organization = button.data('organization')
                var email = button.data('email')
                var notes = button.data('notes')
                var phone = button.data('phone')
                var date = button.data('date')

                var tablewareConfirmation = button.data('tablewareconfirmation')
                console.log(tablewareConfirmation)
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


    </script>
@endsection
