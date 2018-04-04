@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Manage Users</h3></div>
            <div class="panel-body text-center">
                Create, Update and Delete users here.
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td class="pull-right">
                                <a href="{{url('/user/'.$user->id.'/edit')}}" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a href="{{url('/user/'.$user->id.'/delete')}}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection