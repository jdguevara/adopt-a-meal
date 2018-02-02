@extends('emails.emailheader')

@section('content')
<div class="container">
    <p>{{$form['organization_name']}} has requested to adopt-a-meal and needs approval.</p>
    <p>Their request: </p>
    <p>Meal Description: {{$form['meal_description']}}</p>
    <p>Contact Email: {{$form['email']}} </p>
    <p>Contact Phone: {{$form['phone']}} </p>
    <p>Will provide Tableware: </p>
    <p>Please go to the <a href={{url($appUrl)}}>Adopt-A-Meal Admin Page</a> to approve or decline the request.</p>
</div>
@endsection
