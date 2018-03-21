@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-volunteer-form-modaljs') @endcomponent
<script>
var volunteerForms = @json($volunteerForms);
</script>
@endsection


@section('content')
<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Pending Volunteer Requests</h3></div>

            <div class="panel-body text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <p>Review Adopt-a-Meal volunteer requests here.</p>
                <p>To review a volunteer request, click the "Details" 
                button next to the volunteer request's details. Once a volunteer request is accepted, it can be
                edited in the "Past Volunteer Requests" view.</p>
            </div>
        </div>
        @foreach($volunteerForms as $form)
        <ul class="list-group">
            <li class="list-group-item ">
                <h5>{{$form->title}}</h5>
                <h6>From: {{$form->organization_name}}
                    <button id="view-event" onclick="loadAdminReviewVolunteerFormModal({{ $form['id'] }});" class="btn btn-warning event-info-details pull-right">
                            Details
                    </button>
                </h6>
                <h6>Date: {{date('m-d-Y', strtotime($form->event_date_time))}} </h6>
            </li>
        </ul>
        @endforeach
    </div>
</div>
@component('formmodals.admin-review-volunteer-form-modal', ['editMode' => false]) @endcomponent
@endsection


