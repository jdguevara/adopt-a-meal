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

<!-- Meal Idea modal that is displayed when Share is clicked-->
<form id="volunteer-form" method="POST" action="/meal-ideas/submit">
    <div class="modal fade" id="mealidea-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;">Adopt-A-Meal Form</h3>
                </div>

                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div id="inputs" class="volunteer-inputs">
                        <div class="input-group">
                            <span><h5>
                                Please provide the following information. Once the form is
                                complete you will recieve a confirmation e-mail and we will
                                contact you to help ensure your adopted meal will be a success!
                            </h5></span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Volunteer Date</span>
                            <input id="event-date" name="event_date" type="text"  
                                    class="form-control" disabled>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Organization Name</span>
                            <input id="organization_name" name="organization_name" type="text"
                                    class="form-control" placeholder="Organization Name" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email"
                                    required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Phone Number</span>
                            <input id="phone" name="phone" type="text" class="form-control"
                                    placeholder="Phone Number" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">Meal Description</span>
                            <input id="meal_description" name="meal_description" type="text" class="form-control"
                                    placeholder="Meal Description">
                        </div>
                        <div class="input-group">
                            <textarea id="notes" name="notes" class="form-control"
                                        placeholder="Notes"></textarea>
                        </div>
                        <div class="input-group">
                            <span>
                                <strong>
                                By clicking 'Volunteer' I acknowledge that I am volunteering 
                                to be responsible for bringing at least 200 servings to the 
                                Interfaith Sanctuary building by 5pm on the chosen date.
                                </strong>
                            </span>
                            <div class="checkbox-group">
                                <label class="checkbox"> I can provide paper goods
                                    <input id="paper-goods" name="paper_goods" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <!-- rendered from event id stored in calendar -->
                        <input id="event-id" name="open_event_id" type="text" hidden />
                        <input id="event-time" name="open_event_date_time" type="text" hidden />
                        <input id="event-title" name="title" type="text" hidden />
                    </div>

                    <!-- loading spinner -->
                    <div id="loading-info" class="loading-info" hidden>
                        <h3 class="text-light text-center">Your volunteer information is being sent!</h3>
                        <div id="loading-spinner" class="spinner">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        <button id="submit-form" type="button" class="btn btn-success"
                                onClick="submitVolunteerForm();">Volunteer
                        </button>
                        <button id="cancel-form" type="button" class="btn btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" hidden></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </form>
@endsection


