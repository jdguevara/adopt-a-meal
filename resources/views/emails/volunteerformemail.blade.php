@extends('emails.emailheader')

@section('content')
<div class="container">
    <p>{!! $messages['volunteer_email_thank_you'] or 'A request to Adopt-A-Meal has been approved!' !!} </p>
    <p>{!! $messages['volunteer_email_process'] or 'Your request as been forwarded to a volunteer coordinator at Interfaith Sanctuary and you will hear from us shortly.' !!} </p>
    <p>Your Request: </p>
    <p>Event Date: {{$form['open_event_date_time']}}</p>
    <p>Meal Description: {{$form['meal_description']}}</p>
    <p>Contact Email: {{$form['email']}} </p>
    <p>Contact Phone: {{$form['phone']}} </p>
    <p>Will provide paper goods: {{$form['paper_goods'] ? 'yes' : 'no'}} </p>
</div>
@endsection
