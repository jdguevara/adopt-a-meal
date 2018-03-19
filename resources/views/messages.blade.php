@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading text-center text-capitalize"><h3>Messages</h3></div>
            <div class="panel-body text-center">
                Edit application messages here. If you see an application message that you'd like to change, please take
                note of the previous message. Once you change a message, it cannot be undone!
            </div>
        </div>

        <div class="input-group messages-search-bar">
            <span class="input-group-addon">Search</span>
            <input id="search" class="form-control"/>
        </div>

        <ul id="messages-list" class="list-group messages-list">
            @foreach($messages as $m)
                <li id="{{ $m->type }}" class="list-group-item">

                    <div class="row row-padding">
                        <h4 class="text-yellow message-type" style="display: inline-block;">{{ $m->type_str }}</h4>
                        <span class="pull-right text-light" style="font-style: italic"> Updated: {{ $m->updated_str }} </span>
                    </div>

                    <div class="row row-padding">
                        <span id="message-{{ $m->id }}-content">{!! $m->content !!}</span>
                    </div>

                    <div class="row row-padding" style="margin-top: 10px;">
                        <button id="{{ $m->id }}" class="btn btn-success pull-right" onClick="loadMessageModal(this);"
                                role="button">Edit Message
                        </button>
                        <span id="message_id" hidden>{{ $m->id }}</span>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>

    @component('formmodals.admin-change-message-modal') @endcomponent

@endsection


@section('scripts')
    @component('formmodals.admin-change-message-modaljs') @endcomponent
    <script>

        $(document).ready(function () {

            setupMessageValidation();
            var messages = $('#messages-list li');
            delete(messages['length']);
            delete(messages['prevObject']);

            $('#search').on('input', debounce(function() {

                var search = $(this).val();
                for(var i in messages) {
                    if(messages.hasOwnProperty(i)) {
                        var messageElement = $(messages[i]);
                        var text = messageElement.find('.message-type').text().toLowerCase() || "";
                        if(text.includes(search)) {
                            messageElement[0].style.display = "";
                        } else {
                            messageElement[0].style.display = "none";
                        }
                    }
                }

            }, 100));

        });
    </script>
@endsection