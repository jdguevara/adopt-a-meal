<form id="meal-idea-review-form" method="POST" action="/admin/meal-ideas/review">
    {{ csrf_field() }}
    <div class="modal fade" id="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="margin-top: 15px;">Suggested Meal</h3>
                </div>
                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">
                    <div class="container-fluid volunteer-inputs">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Name</span>
                                <input id="meal-title" name="title" class="form-control" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Meal Description</span>
                                <input id="description" name="description" class="form-control" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <textarea id="instructions" name="instructions" class="form-control" placeholder="Instructions"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">External Link</span>
                                <input id="external-link" name="external_link" class="form-control"  type="text"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Ingredient List</span>
                                <textarea id="ingredients" name="ingredients" class="form-control" type="text"> </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Submitter Name</span>
                                <input id="name" name="name" class="form-control" type="text" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Submitter Email</span>
                                <input id="email" name="email" class="form-control" type="text" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="checkbox-group">
                                    <label class="checkbox"> Display on Meal Ideas Page
                                        <input id="display" name="display" type="checkbox" checked required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input id="meal-id" name="id" type="text" hidden />
                        <input  id="new-status" name="new_status" type="text" hidden>
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
                        <button id="approve" type="button" class="btn btn-success" onClick="submitMealIdeaReview(1);">
                            Approve
                        </button>
                        <button id="deny" type="button" class="btn btn-warning" onClick="submitMealIdeaReview(2);">
                            Deny
                        </button>
                        <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>