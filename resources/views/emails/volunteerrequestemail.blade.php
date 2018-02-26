@extends('emails.emailheader')

@section('content')
<div class="container">
    <p>{{'Org_name'}} has requested to adopt-a-meal and needs approval.</p>
    <p>Their request:</p>
    <p>Please go to the <a href={{url($appUrl)}}>Adopt-A-Meal Admin Page</a> to approve or decline the request.</p>
</div>
@endsection
