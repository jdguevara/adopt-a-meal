@extends('layouts.app')


@section('content')
<div class="row">

    <ul class="list-group">
        @foreach($messages as $m)
            <li class="list-group-item" style="text-align: center">
                <span>Type: {{ $m->type }} </span>
                <span>Version: {{ $m->version }} </span>
                <span>Last Updated On: {{ date('m-d-Y', strtotime($m->updated_at)) }} </span>
                <span>Message: {{ $m->content }}</span>
                <span><button class="btn btn-default">Change Message</button></span>
            </li>
        @endforeach
    </ul>

</div>

@endsection