@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-volunteer-form-js') @endcomponent
<script>
var volunteerForms = @json($volunteerForms);
</script>
@endsection


@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Admin Dashboard</h3></div>

            <div class="panel-body text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in!
                Accept, Edit and Delete Adopt-a-Meal requests here.
            </div>
        </div>
        @foreach($volunteerForms as $form)
            <ul class="list-group">
                <li class="list-group-item ">
                    <h5>{{$form->title}}</h5>
                    <h6>From: {{$form->organization_name}}
                        <button id="view-event" onclick="loadAdminReviewVolunteerFormModal('{{$form['id']}}');" class="btn btn-warning event-info-details pull-right">
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


