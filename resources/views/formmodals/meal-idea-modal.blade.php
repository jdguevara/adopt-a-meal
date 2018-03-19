<!-- Meal Idea modal that is displayed when Share is clicked-->
<form id="meal-idea-form" method="POST" action="api/meal-ideas/submit">
    <div class="modal fade" id="meal-idea-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="title">Suggest a Meal Idea</h3>
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
                                <input id="meal-title" name="title" type="text" class="form-control" placeholder="Meal Name" required>
                            </div>
                            <div id="meal-title-validation" class="hidden alert-danger">Required: Please enter a title for the meal</div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Description</span>
                                <input id="description" name="description" type="text" class="form-control" placeholder="Meal Description" required>
                            </div>
                            <div id="description-validation" class="hidden alert-danger">Required: Please enter a description of the meal</div>
                        </div>

                        <div class="form-group">
                            <h4>Ingredients:</h4>
                            <div id="dynamic_field">
                                <div class="ingredient input-group">
                                    <input type="text" id="ingredients" name="ingredient[]" placeholder="Enter an ingredient" class="form-control ingredient_list" />
                                    <span class="input-group-btn">
                                        <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                    </span>
                                </div>
                            </div>
                            <div id="ingredients-validation" class="hidden alert-danger">Required: Please provide a list of ingredients needed to make your meal idea</div>
                        </div>

                        <div class="form-group">
                            <h4>Instructions:</h4>
                            <div class="input-group">
                                <textarea id="instructions" name="instructions" class="form-control" placeholder="Instructions"></textarea>
                            </div>
                            <div id="instructions-validation" class="hidden alert-danger">Required: Please provide instructions to prepare the meal</div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Source Website</span>
                                <input id="external-link" name="external_link" type="text" class="form-control" placeholder="Link to the Source Website">
                            </div>
                            <p class="help-block">Optional</p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Your Name</span>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Your Name">
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
                        <h3 class="text-light text-center">Your recipe is being submitted for review!</h3>
                        <div id="loading-spinner" class="spinner">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                    </div>
                </div>

                <div id="input-buttons" class="modal-footer">
                    <div class="input-group pull-right">
                        <button id="submit-form" type="button" class="btn btn-success" onClick="submitMealIdea();">Submit</button>
                        <button id="cancel-form" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>
</form>