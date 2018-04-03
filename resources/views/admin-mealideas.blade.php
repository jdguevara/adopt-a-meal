@extends('layouts.app')

@section('scripts')
@component('formmodals.admin-review-meal-idea-modaljs') @endcomponent
<script>
var mealIdeas = @json($mealideas);

$(document).ready(function () {
    setupMealIdeaReviewValidation();    
});
</script>
@endsection


@section('content')
<div class="row">
    <h5 class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Review Meal Ideas</h3></div>
            <div class="panel-body text-center">
                Accept, Edit, and Delete Meal Ideas here.
            </div>
        </div>

        @foreach($mealideas as $mealidea)
            <ul class="list-group">
                <li class="list-group-item list-group-container">
                    <h5>{{$mealidea->title}}</h5>
                    <h5>From: {{$mealidea->name}}</h5>
                    <button onclick="loadMealIdeaReviewModal('{{$mealidea['id']}}');" class="btn btn-warning pull-right">Details</button>
>>>>>>> Stashed changes
                </li>
            </ul>
        @endforeach
    </div>
</div>

@component('formmodals.admin-review-meal-idea-modal', ['editMode' => false]) @endcomponent
@endsection
