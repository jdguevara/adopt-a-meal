@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <hr/>
        <form action="{{url('/users/'.$user->id.'/update')}}" method="post" >
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-4 form-group">
                    <label for="name">Name</label>
                    <input type="text"
                           class="form-control"
                           name="name"
                           id="name"
                           value="{{$user->name}}">
                </div>
                <div class="col-sm-4 form-group">
                    <label for="email">Email</label>
                    <input type="text"
                           class="form-control"
                           name="email"
                           id="email"
                           value="{{$user->email}}" disabled>
                </div>
            </div>
            <div class="form-group {{ $errors->has('isAdmin') ? 'has-error' : '' }}">
                <input type="hidden"
                       name="is_admin"
                       value="off">
                <input type="checkbox"
                       class="checkbox"
                       name="is_admin"
                       id="isAdmin"
                       @if($user->is_admin === 1) checked @endif>

                <label for="is_admin">Is An Admin</label>
            </div>
            <hr>
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
        <span class="change-message-warning-text"> *To change password for this user, use the "Forgot Password" functionality located on the login page. </span>
    </div>
@endsection