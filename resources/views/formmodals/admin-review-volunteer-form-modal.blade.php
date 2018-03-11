<form id="event-form" method="POST" action="/admin/form/review">
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
                                <input id="meal-description" class="form-control" @if(!$editMode) disabled @endif/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Organization Name</span>
                                <input id="organization-name" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Date</span>
                                <input id="event-date-time" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Email</span>
                                <input id="email" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Phone</span>
                                <input id="phone" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Notes</span>
                                <input id="notes" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Paper Goods</span>
                                <input id="paper-goods" class="form-control" @if(!$editMode) disabled @endif />
                            </div>
                        </div>
                        <input type="text" id="open-event-id" name="open_event_id" hidden>
                        <input type="text" id="volunteer-id" name="volunteer_id" hidden>
                        <input type="text" id="approve-event" name="approve_event" hidden>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="input-group pull-right">
                        @if(!$editMode)
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm(1);">
                            Approve
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm(0);">
                            Deny
                        </button>
                        @else
                        <button id="approve" type="button" class="btn btn-success" onClick="submitAdminReviewVolunteerForm(1);">
                            Update
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitAdminReviewVolunteerForm(0);">
                            Cancel Volunteer Event
                        </button> 
                        @endif

                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>