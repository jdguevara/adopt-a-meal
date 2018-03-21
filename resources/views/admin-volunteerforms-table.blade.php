@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-volunteer-form-modaljs') @endcomponent
<script>
var volunteerforms = @json($volunteerforms);

</script>
@endsection


@section('content')
<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Past Volunteer Requests</h3></div>
            <div class="panel-body text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                View past volunteer requests by month in the table below. To view past months click the "Previous" button.
                Previously accepted volunteer requests can be cancelled. Once cancelled, the volunteer's calendar event
                will be removed the Adopt-A-Meal calendar and a new "Click here to Adopt-A-Meal!" event will be created.
                To edit an already submitted volunteer request, click "Edit" in a row. 
            </div>
        </div>

        <nav aria-label="...">
            <ul class="pager">
                <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Previous Month</a></li>
                <li class="next"><a href="#">Next Month <span aria-hidden="true">&rarr;</span></a></li>
            </ul>
        </nav>

        <div class="table-responsive">
            <h3 class="text-center">Current Month</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Meal Name</th>
                        <th>Description</th>
                        <th>Website</th>
                        <th>Submitter Name</th>
                        <th>Submitter Email</th>
                        <th>Bringing Paper Goods</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteerforms as $volunteerform)
                    <tr>
                        <td>{{ $volunteerform->title }}</td>
                        <td>{{ $volunteerform->meal_description }}</td>
                        <td>{{ $volunteerform->website }}</td>
                        <td>{{ $volunteerform->organization_name }}</td>
                        <td>{{ $volunteerform->email }}</td>
                        <td>{{ $volunteerform->paper_goods ? "Yes" : "No" }}</td>

                        <td><button onclick="loadAdminReviewVolunteerFormModal('{{ $volunteerform['id'] }}');" class="btn btn-warning">Edit</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@component('formmodals.admin-review-volunteer-form-modal', ['editMode' => true]) @endcomponent
@endsection
