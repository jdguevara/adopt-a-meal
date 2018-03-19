@extends('emails.emailheader')

@section('content')
    <div class="container">
        <p>{{ $messages['admin_approved_email'] }} </p>
        <p>Their request: </p>
        <p>{{$form['organization_name']}}</p>
        <p>Event Date: {{$form['open_event_date_time']}}</p>
        <p>Meal Description: {{$form['meal_description']}}</p>
        <p>Contact Email: {{$form['email']}} </p>
        <p>Contact Phone: {{$form['phone']}} </p>
        <p>Will provide paper goods: {{$form['paper_goods'] ? 'yes' : 'no'}}</p>
    </div>
@endsection