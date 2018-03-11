@extends('layouts.app')


@section('content')

<h1 style="padding-left: 15px;"> Messages </h1>

<div class="col-sm-12 col-lg-6">

<ul class="list-group">

    @foreach($messages as $m)

        <li class="list-group-item">

            <div class="row row-padding">
                <h2 style="display: inline-block;"> {{ $m->type }}</h2>
                <span> - Last Updated: {{ date('m-d-Y', strtotime($m->updated_at)) }} </span>
            </div>

            <div class="row row-padding">
                <span id="message-{{ $m->id }}-content">{{ $m->content }}</span>
                <button id="message-{{ $m->id }}-edit" class="btn btn-default pull-right">Edit Message</button>

                {{-- this is for jquery to hook into the message that was clicked --}}
                <span id="message_id" hidden>{{ $m->id }}</span>
            </div>

        </li>
    @endforeach

</ul>

</div>

@endsection