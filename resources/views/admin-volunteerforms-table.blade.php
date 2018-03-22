@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-volunteer-form-modaljs') @endcomponent
<script>
var volunteerForms = @json($volunteerforms);
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
                        <th>Organization Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Meal Description</th>
                        <th>Notes</th>
                        <th>Bringing Paper Goods</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteerforms as $volunteerform)
                    <tr>
                        <td>{{ $volunteerform->organization_name }}</td>
                        <td>{{ $volunteerform->email }}</td>
                        <td>{{ $volunteerform->phone }}</td>
                        <td>{{ $volunteerform->meal_description }}</td>
                        <td>{{ $volunteerform->notes }}</td>
                        <td>{{ $volunteerform->paper_goods ? "Yes" : "No" }}</td>

                        <td>
                        @switch($volunteerform->form_status)
                            @case(0)
                                <i>Pending Review</i>
                                @break

                            @case(1)
                                <button onclick="loadAdminReviewVolunteerFormModal('{{ $volunteerform['id'] }}');" class="btn btn-warning">Edit</button>
                                @break

                            @case(2)
                                <i>Denied</i>
                                @break
                            @case(3)
                                <i>Cancelled</i>
                                @break
                            @default
                                <i>LostInSpace</i>
                        @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@component('formmodals.admin-review-volunteer-form-modal', ['editMode' => true]) @endcomponent
@endsection
