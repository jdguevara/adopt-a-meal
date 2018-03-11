@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-meal-idea-js') @endcomponent
<script>
var mealIdeas = @json($mealideas);

$(document).ready(function () {
    setupMealIdeaReviewValidation();    
});
</script>
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Current Meal Ideas</h3></div>
            <div class="panel-body text-center">
                Approved meal ideas are displayed in the table below. Meal ideas can be hidden from the public by unchecking the "Display" checkbox
                and updating the meal idea. To edit a meal idea, click the "Edit" button its a row.
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Meal Name</th>
                        <th>Description</th>
                        <th>Website</th>
                        <th>Submitter Name</th>
                        <th>Submitter Email</th>
                        <th>Displayed</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mealideas as $mealidea)
                    <tr>
                        <td>{{ $mealidea->title }}</td>
                        <td>{{ $mealidea->description }}</td>
                        <td>{{ $mealidea->external_link }}</td>
                        <td>{{ $mealidea->name }}</td>
                        <td>{{ $mealidea->email }}</td>
                        <td>{{ $mealidea->display ? "Yes" : "No" }}</td>
                        <td><button onclick="loadMealIdeaReviewModal('{{$mealidea['id']}}');" class="btn btn-warning">Edit</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@component('formmodals.admin-review-meal-idea-modal', ['editMode' => true]) @endcomponent
@endsection
