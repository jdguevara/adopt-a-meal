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
            <ul class="list-group">
                <li class="list-group-item "><div class="row"><div class= "col-sm-8"><h5>yo ho</h5></div><div class="btn-toolbar col-sm-4"><button type="button" class="btn btn-primary pull-right ">Edit</button> <button type="button" class="btn btn-warning pull-right ">Delete</button></div></div></li>
            </ul>

        </div>
    </div>
</div>
@endsection
