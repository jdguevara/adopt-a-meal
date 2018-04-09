@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Manage Users</h3></div>
            <div class="panel-body text-center">
                Create, Update and Delete users here.
            </div>
        </div>
        <a class="btn btn-success" href="{{url('/users/create')}}"><span class="glyphicon glyphicon-plus"></span>  Add New User</a>
        <hr/>
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
                            <td>
                                <form id="userDeleteForm{{$user->id}}" action="{{url('/users/'.$user->id.'/delete')}}" method="get" hidden>
                                    {{csrf_field()}}
                                </form>
                                <a href="{{url('/users/'.$user->id.'/edit')}}" class="btn btn-warning" title="Edit User">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a class="btn btn-primary" title="Delete User" onclick="confirmAndDelete({{$user->id}})">
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

@section('scripts')
    <script>
      function confirmAndDelete(id) {
        if(confirm('Are you sure you want to delete this user?')) {
          $('#userDeleteForm'+id).submit();
        }
      }
    </script>
@endsection