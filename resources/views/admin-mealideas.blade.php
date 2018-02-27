@extends('layouts.app')

@section('scripts')
    <script>

        var mealIdeas = {!! json_encode($mealideas) !!};

        function viewMealIdea (id) {
            // find the particular meal idea in our meal idea list
            var idea = mealIdeas.find(function(event) { return event.id == id; });

            $("#meal-title").val(idea.title);
            $('#description').val(idea.description);
            $('#email').val(idea.email);
            $('#name').val(idea.name);
            $('#external-link').val(idea.external_link);
            $('#meal-id').val(idea.id);

            var ingredients = JSON.parse(idea.ingredients_json);
            $('#ingredients').val(ingredients.join(', ')); 
            $("#event-modal").modal();
        }

        function submitEvent (status) {
            // send the form, value set in jquery is async apparently?
            $('#new-status').val(status);
            $('#event-form').submit();
        }
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

                <form id="event-form" method="POST" action="/admin/meal-ideas/review">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="modal fade" id="event-modal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 style="margin-top: 15px;">Suggested Meal</h3>
                                </div>
                                <!-- list of text field inputs and check boxes  -->
                                <div class="modal-body event-info">
                                    <div class="input-group">
                                        <span class="input-group-addon">Meal Name</span>
                                        <input id="meal-title" name="title" class="form-control" type="text" />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Meal Description</span>
                                        <input id="description" name="description" class="form-control" type="text" />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">External Link</span>
                                        <input id="external-link" name="external_link" class="form-control"  type="text"/>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Ingredient List</span>
                                        <textarea id="ingredients" name="ingredients" class="form-control" type="text"> </textarea>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Submitter Name</span>
                                        <input id="name" name="name" class="form-control" type="text" />
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">Submitter Email</span>
                                        <input id="email" name="email" class="form-control" type="text" />
                                    </div>
                                </div>

                                <input id="meal-id" name="id" type="text" hidden />
                                <input  id="new-status" name="new_status" type="text" hidden>

                                <div class="modal-footer">
                                    <div class="input-group pull-right">
                                        <button id="approve"
                                                type="button"
                                                class="btn btn-success"
                                                onClick="submitEvent(1);">
                                            Approve
                                        </button>

                                        <button id="deny"
                                                type="button"
                                                class="btn btn-warning"
                                                onClick="submitEvent(2);">
                                            Deny
                                        </button> 
                                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @foreach($mealideas as $mealidea)
                    <ul class="list-group">
                        <li class="list-group-item ">
                            <h5>{{$mealidea->title}}</h5>
                            <h6>From: {{$mealidea->name}}
                            <button id="view-event" onclick="viewMealIdea('{{$mealidea['id']}}');" class="btn btn-warning event-info-details pull-right">
                                Details
                            </button>
                            </h6>
                        </li>
                    </ul>

                @endforeach
            </div>


        </div>

@endsection
