<form id="event-form" method="POST" action="/admin/settings/update-form">
    {{ csrf_field() }}
    <div class="modal fade" id="event-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title" style="margin-top: 15px;"></h3>
                </div>
                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div id="inputs" class="container-fluid volunteer-inputs">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Description</span>
                                <input type="text" id="meal-description" name="meal_description" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Organization Name</span>
                                <input type="text" id="organization-name" name="organization_name" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Date</span>
                                <input type="text" id="event-date-time" name="open_event_date_time" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Email</span>
                                <input type="text" id="email" name="email" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Phone</span>
                                <input type="text" id="phone" name="phone" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Notes</span>
                                <input type="text"id="notes" name="notes" class="form-control"  @if(!$editMode) disabled @endif/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Paper Goods</span>
                                <input type="text" id="paper-goods" name="paper_goods" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>
                        <input type="text" id="open-event-id" name="open_event_id" hidden>
                        <input type="number" id="volunteer-id" name="volunteer_id" hidden>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        @if($editMode)
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm(2);">
                            Update
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm(3);">
                            Cancel Volunteer Event
                        </button> 
                        @else
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm(1);">
                            Approve
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm(0);">
                            Deny
                        </button>        
                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>