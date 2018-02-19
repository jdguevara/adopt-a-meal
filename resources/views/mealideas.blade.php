@extends('layouts.app')

@section('scripts')
<script>
function mealIdeaModal() {
    // clear form fields from previous events
    $("#mealidea-modal").trigger("reset");

    $("#mealidea-modal").modal();
};

function submitMealIdea() {
console.log('test');
var $form = $('#mealidea-form');

// if the form isn't valid, "click" the submit button which will force html5 validation
// else, send it!
if(!$form[0].checkValidity()) {
    $form.find(':submit').click();
} else {    
    $("#inputs").hide();
    $("#loading-info").show();
    $form.submit();
}
}

</script>
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h2>Meals Suggested By Volunteers and Community Members</h2>
        <h2><small>If you have an idea click here <button class="btn btn-primary" href="#" onClick="mealIdeaModal();" role="button">Share</button></small></h2>
    </div>
</div>
<div class="container">
    @foreach ($mealideas as $mealidea)
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

<!-- Meal Idea modal that is displayed when Share is clicked-->
<form id="mealidea-form" method="POST" action="/meal-ideas/submit">
    <div class="modal fade" id="mealidea-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;">Suggest a Meal Idea</h3>
                </div>

                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div id="inputs" class="volunteer-inputs">
                        <div class="input-group">
                            <p>Thank you for taking the time to fill out a meal idea!</p>
                            <p>A provided recipe should be able to make at least 200 portions</p>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Name</span>
                                <input id="meal-name" name="meal_name" type="text" class="form-control" placeholder="Meal Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Description</span>
                                <input id="description" name="description" type="text" class="form-control" placeholder="Meal Description" required>
                            </div>
                        </div>
                        <!-- <div>Figure out how to make a table that you can continue adding lines to</div>  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Source Website</span>
                                <input id="external-link" name="external_link" type="text" class="form-control" placeholder="Link to the Source Website">
                            </div>
                            <p class="help-block">Optional</p>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Your Name</span>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Your Email">
                            </div>
                            <p class="help-block">Optional</p>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Your Email</span>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Your Email">
                            </div>
                            <p class="help-block">Optional</p>
                        </div>
                    </div>

                    <!-- loading spinner -->
                    <div id="loading-info" class="loading-info" hidden>
                        <h3 class="text-light text-center">Your idea is being sent!</h3>
                        <div id="loading-spinner" class="spinner">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        <button id="submit-form" type="button" class="btn btn-success" onClick="submitMealIdea();">Submit</button>
                        <button id="cancel-form" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </form>
@endsection


