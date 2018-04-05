@extends('layouts.app')

@section('scripts')
@component('formmodals.meal-idea-modaljs') @endcomponent
<script>
$(document).ready(function () {
    setupMealIdeaValidation();    
});
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="page-header">
            <h1>{{ $messages['meal_ideas_title'] }}</h1>
            <h2><small>{{ $messages['meal_ideas_share_prompt'] }} <button class="btn btn-primary" href="#" onClick="loadMealIdeaModal();" role="button">Share</button></small></h2>
        </div>

        @foreach ($mealideas as $mealidea)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">{{$mealidea->title}}</div>
                <div class="panel-body">
                    <h6>{{$mealidea->description}}</h6>
                </div>
                @if($mealidea->ingredients)
                    <ul class="list-group">
                        @foreach($mealidea->ingredients as $ingredient)
                            <li class="list-group-item">{{$ingredient}}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="panel-body">
                    <h4>Instructions</h4>
                    <h5>{{$mealidea->instructions}}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@component('formmodals.meal-idea-modal', [ 'messages' => $messages ]) @endcomponent

@endsection


