<script>
function loadMealIdeaReviewModal (id) {
    // find the particular meal idea in our meal idea list
    var idea = mealIdeas.find(function(event) { return event.id == id; });

    $("#meal-title").val(idea.title);
    $('#instructions').val(idea.instructions);
    $('#description').val(idea.description);
    $('#email').val(idea.email);
    $('#name').val(idea.name);
    $('#external-link').val(idea.external_link);
    $('#meal-id').val(idea.id);

    var ingredients = JSON.parse(idea.ingredients_json);
    $('#ingredients').val(ingredients.join(', '));

    resetJQueryValidation(inputIds, true);
    $("#modal").modal();
}

var inputIds = ['#meal-title', '#instructions', '#description', '#ingredients'];

function setupMealIdeaReviewValidation() {
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

function submitMealIdeaReview (status) {
    $('#new-status').val(status);

    var valid = true;
    $.each(inputIds, function(index, value) {
        valid = simpleJQueryValidity(value + '-validation') ? valid ? true : false : false;
    });
    if(valid) {
        $("#inputs").hide();
        $("#input-buttons").hide();
        $("#loading-info").show();
        $('#meal-idea-review-form').submit();
    }
}
</script>