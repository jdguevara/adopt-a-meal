@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-capitalize"><h3>Admin Dashboard</h3></div>

                <div class="panel-body admin-panel text-center">
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
                            <p class="email"></p>
                            <p class="notes"></p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info pull-left" v-if="" data-dismiss="modal">Accept</button>
                            <button type="button" class="btn btn-warning pull-left" v-if="" data-dismiss="modal">Edit</button>
                            <button type="button" class="btn btn-danger pull-left" v-if="" data-dismiss="modal">Delete</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            @foreach($forms as $form)
                <ul  class="list-group">
                    <li class="list-group-item "><div class="row">
                            <div class= "col-sm-6">
                                <h5>{{$form['organization']}}</h5>
                            </div>
                            <div class="btn-toolbar col-sm-6">
                                <button type="button" class="btn btn-danger pull-right " data-toggle="modal" :data-organization="{{json_encode($form['organization'],true)}}" :data-email="{{json_encode($form['email'],true)}}" :data-notes="{{json_encode($form['notes'],true)}}"  data-target="#myModal">Delete</button>
                                <button type="button" class="btn btn-warning pull-right " data-toggle="modal" :data-organization="{{json_encode($form['organization'],true)}}" :data-email="{{json_encode($form['email'],true)}}" :data-notes="{{json_encode($form['notes'],true)}}" data-target="#myModal">Edit</button>
                                <button type="button" class="btn btn-info pull-right " data-toggle="modal" :data-organization="{{json_encode($form['organization'],true)}}" :data-email="{{json_encode($form['email'],true)}}" :data-notes="{{json_encode($form['notes'],true)}}" data-target="#myModal">Accept</button>

                            </div>
                        </div>
                    </li>
                </ul>

            @endforeach
        </div>


    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        //call your script.js function from here

        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var organization = button.data('organization') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var notes = button.data('notes') // Extract info from data-* attributes
            var type = button.data('yo')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text( organization)
            modal.find('.email').text("Email: " + email)
            modal.find('.notes').text("Notes: " + notes)
            modal.find('.type').text(type)
        })
    });
</script>