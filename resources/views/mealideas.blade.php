@extends('layouts.app')

@section('scripts')


<script>
</script>


@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h2>Meals Suggested By Volunteers and Community Members</h2>
        <h2><small>If you have an idea click here <button class="btn btn-primary" href="#" role="button">Share</button></small></h2>
    </div>
</div>
<div class="container">
    @foreach ($recipes as $recipe)
    <div class="col-12 col-md-6 col-lg-3">
        <div class="panel panel-default">
            <div class="panel-heading">Recipe Title</div>
            <div class="panel-body">
                Description
            </div>
            <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection


