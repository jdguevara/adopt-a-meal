@extends('layouts.app')

@section('scripts')
@component('formmodals.meal-idea-js') @endcomponent
<script>

</script>
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h2>Meals Suggested By Volunteers and Community Members</h2>
        <h2><small>If you have an idea click here <button class="btn btn-primary" href="#" onClick="loadMealIdeaModal();" role="button">Share</button></small></h2>

        @if(isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {!! implode('<br />', $errors->all()) !!}
            </div>
        @endif
        @include('flash::message')
    </div>
</div>
<div class="container">
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
        </div>
    </div>
    @endforeach
</div>

@component('formmodals.meal-idea-modal') @endcomponent

@endsection


