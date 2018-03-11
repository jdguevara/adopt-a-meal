<script>
function loadMealIdeaReviewModal (id) {
    // find the particular meal idea in our meal idea list
    var idea = mealIdeas.find(function(event) { return event.id == id; });
    resetMealIdeaValidation();

    $("#meal-title").val(idea.title);
    $('#instructions').val(idea.instructions);
    $('#description').val(idea.description);
    $('#email').val(idea.email);
    $('#name').val(idea.name);
    $('#external-link').val(idea.external_link);
    $('#meal-id').val(idea.id);

    var ingredients = JSON.parse(idea.ingredients_json);
    $('#ingredients').val(ingredients.join(', ')); 
    $("#modal").modal();
}

function simpleJQueryValidation(event, validation_id, regex) {
    if($(event).val()) {
        var checkRegex = regex == undefined || regex.test($(event).val());
        if (checkRegex) {
            $(validation_id).addClass('hidden');
            $(validation_id).addClass('valid');
        } else {
            $(validation_id).removeClass('hidden');
            $(validation_id).removeClass('valid');
        }
    }
}

function setupMealIdeaValidation() {
    $('#meal-title').on('input', function () {
        simpleJQueryValidation(this, '#meal-title-validation');
    });
    $('#instructions').on('input', function () {
        simpleJQueryValidation(this, '#instructions-validation');
    });
    $('#description').on('input', function () {
        simpleJQueryValidation(this, '#description-validation');
    });
    $('#ingredients').on('input', function () {
        simpleJQueryValidation(this, '#ingredients-validation');
    });
}

function resetMealIdeaValidation(){
    $('#meal-title-validation').addClass('hidden');
    $('#meal-title-validation').removeClass('valid');
    $('#instructions-validation-validation').addClass('hidden');
    $('#instructions-validation-validation').removeClass('valid');
    $('#description-validation').addClass('hidden');
    $('#description-validation').removeClass('valid');
    $('#ingredients-validation').addClass('hidden');
    $('#ingredients-validation').removeClass('valid');
}


function submitMealIdeaReview (status) {
    $('#new-status').val(status);
    $('#meal-idea-review-form').submit();
}
</script>