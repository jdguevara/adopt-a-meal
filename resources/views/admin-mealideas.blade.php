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
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Review Meal Ideas</h3></div>
            <div class="panel-body text-center">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                Accept, Edit and Delete Meal Ideas here.
            </div>
        </div>

        @foreach($mealideas as $mealidea)
            <ul class="list-group">
                <li class="list-group-item ">
                    <h5>{{$mealidea->title}}</h5>
                    <h6>From: {{$mealidea->name}}
                    <button onclick="loadMealIdeaReviewModal('{{$mealidea['id']}}');" class="btn btn-warning event-info-details pull-right">
                        Details
                    </button> 
                    </h6>
                </li>
            </ul>
        @endforeach
    </div>
</div>

@component('formmodals.admin-review-meal-idea-modal') @endcomponent
@endsection
