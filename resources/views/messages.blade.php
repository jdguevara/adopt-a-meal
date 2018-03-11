@extends('layouts.app')


@section('content')

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading text-center text-capitalize"><h3>Messages</h3></div>
        <div class="panel-body text-center">
            Edit application messages here. If you see an application message that you'd like to change, please take note of the previous
            message. Once you change a message, it cannot be undone!
        </div>
    </div>

    <ul class="list-group">
        @foreach($messages as $m)

            <li class="list-group-item">

                <div class="row row-padding">
                    <h2 style="display: inline-block;"> {{ $m->type_str }}</h2>
                    <span class="pull-right" style="font-style: italic"> Updated: {{ $m->updated_str }} </span>
                </div>

                <div class="row row-padding">
                    <span id="message-{{ $m->id }}-content">{{ $m->content }}</span>
                </div>

                <div class="row row-padding" style="margin-top: 10px;">
                    <button id="message-{{ $m->id }}-edit" class="btn btn-success pull-right">Edit Message</button>
                    {{-- this is for jquery to hook into the message that was clicked --}}
                    <span id="message_id" hidden>{{ $m->id }}</span>
                </div>

            </li>
        @endforeach

    </ul>


</div>

@endsection