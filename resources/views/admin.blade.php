@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Admin Dashboard</h3></div>

                <div class="panel-body">
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
                            {{--<h4 class="modal-title">{{json_decode($form,true)['organization']}}</h4>--}}
                        </div>
                        <div class="modal-body">
                            {{--<p>Notes: {{json_decode($form,true)['organization']}}</p>--}}
                            {{--<p>Notes: {{json_decode($form,true)['email']}}</p>--}}

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left" v-if="" data-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            @foreach($forms as $form)
                <ul v-if="false" class="list-group">
                    <li class="list-group-item "><div class="row">
                            <div class= "col-sm-6">
                                <h5>{{json_decode($form,true)['organization']}}</h5>
                            </div>
                            <div class="btn-toolbar col-sm-6">
                                <button type="button" class="btn btn-warning pull-right " data-toggle="modal" data-target="#myModal">Accept</button>
                                <button type="button" class="btn btn-primary pull-right ">Edit</button>
                                <button type="button" class="btn btn-danger pull-right " data-toggle="modal" :data-whatever="{{!!json_encode(json_decode($form,true)['organization'],true)}}" data-target="#myModal">Delete</button>
                            </div>
                        </div>
                    </li>
                </ul>

            @endforeach
        </div>


    </div>
</div>

@endsection
<script>
    $document.ready(function()
    {
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body input').val(recipient)
        })
    });
</script>