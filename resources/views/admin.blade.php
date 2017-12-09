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
                                <h5>Organization: {{$form['organization']}}, Date </h5>

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

@section('scripts')
    <script>
            $(document).ready(function(){
                $('#myModal').on('show.bs.modal',function(event) {
                    var button = $(event.relatedTarget)
                    var organization = button.data('organization')
                    var email = button.data('email')
                    var notes = button.data('notes')
                    var type = button.data('yo')

                    var modal = $(this)
                    modal.find('.modal-title').text(organization)
                    modal.find('.email').text("Email: " + email)
                    modal.find('.notes').text("Notes: " + notes)
                    modal.find('.type').text(type)
                })

            });


    </script>
@endsection