<!-- Volunteer form modal that is displayed when an event is clicked -->
<form id="volunteer-form" class="volunteer-form" method="POST" action="/api/form/submit">
    <div class="modal fade" id="volunteer-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;">Adopt-A-Meal Form</h3>
                </div>
                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div id="inputs" class="container-fluid volunteer-inputs">
                        <span><h5>
                            Please provide the following information. Once the form is
                            complete you will recieve a confirmation e-mail and we will
                            contact you to help ensure your adopted meal will be a success!
                        </h5></span>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Volunteer Date</span>
                                <input id="event-date" name="event_date" type="text" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Organization Name</span>
                                <input id="organization_name" name="organization_name" type="text" class="form-control" placeholder="Organization Name" >
                            </div>
                            <div id="organization_name-validation" class="hidden alert-danger">Required: Please enter your Organization's Name</div>                            
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Email</span>
                                <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                            </div>
                            <span id="email-validation" class="help-block hidden alert-danger">Required: Please enter a valid email address</span>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Phone Number</span>
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone Number" >
                            </div>
                            <div id="phone-validation" class="hidden alert-danger">Required: Please enter a valid phone number</div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Description</span>
                                <input id="meal_description" name="meal_description" type="text" class="form-control" placeholder="Meal Description">
                            </div>
                            <div id="meal_description-validation" class="hidden alert-danger">Required: Please enter a description of the meal</div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea id="notes" name="notes" class="form-control" placeholder="Notes"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
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
                                        <input id="paper_goods" name="paper_goods" type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- rendered from event id stored in calendar -->
                        <input id="event-id" name="open_event_id" type="text" hidden />
                        <input id="event-time" name="open_event_date_time" type="text" hidden />
                        <input id="event-title" name="title" type="text" hidden />
                    </div> <!-- end inputs -->

                    <!-- loading spinner -->
                    <div id="loading-info" class="loading-info" hidden>
                        <h3 class="text-light text-center">Your volunteer information is being sent!</h3>
                        <div id="loading-spinner" class="spinner">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                    </div>
                </div> <!-- End modal body -->

                <div id="input-buttons" class="modal-footer">
                    <div class="input-group pull-right">
                        <button id="submit-form" type="button" class="btn btn-success"
                                onClick="submitVolunteerForm();">Volunteer
                        </button>
                        <button  id="cancel-form" type="button" class="btn btn-default" data-dismiss="modal" >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>