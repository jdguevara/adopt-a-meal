@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit User</h2>
        <hr/>
        <form action="{{url('/users/update')}}" method="post" >
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
                           value="{{$user->email}}">
                </div>
            </div>
            <div class="">

            </div>
        </form>
    </div>
@endsection