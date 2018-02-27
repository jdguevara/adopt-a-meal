@extends('emails.emailheader')

@section('content')
<div class="container">
    <p>Thank you for submitting your request to Adopt-A-Meal at the Interfaith Sanctuary!</p>
    <p>Your request as been forwarded to the volunteer coordinator at Interfaith Sanctuary and you will hear from them shortly.</p>
    <p>Your Request: </p>
    <p>Event Date: {{$form['open_event_date_time']}}</p>
    <p>Meal Description: {{$form['meal_description']}}</p>
    <p>Contact Email: {{$form['email']}} </p>
    <p>Contact Phone: {{$form['phone']}} </p>
    <p>Will provide paper goods: {{isset($form['paper_goods']) ? 'yes' : 'no'}} </p>
</div>
@endsection
