<script>
function loadMealIdeaReviewModal (id) {
    // find the particular meal idea in our meal idea list
    let idea = mealIdeas.find(function(event) { return event.id == id; });

    $("#meal-title").val(idea.title);
    $('#instructions').val(idea.instructions);
    $('#description').val(idea.description);
    $('#email').val(idea.email);
    $('#name').val(idea.name);
    $('#external-link').val(idea.external_link);
    $('#meal-id').val(idea.id);

    let ingredients = JSON.parse(idea.ingredients_json);
    $('#ingredients').val(ingredients.join(', '));

    resetJQueryValidation(inputIds, true);
    $("#modal").modal();
}

const inputIds = ['#meal-title', '#instructions', '#description', '#ingredients'];

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

function submitMealIdeaReview (action) {
    var baseUrl = '/admin/meal-ideas/';
    var valid = true;
    $.each(inputIds, function(index, value) {
        valid = simpleJQueryValidity(value + '-validation');
    });
    if(valid) {
        $("#inputs").hide();
        $("#input-buttons").hide();
        $("#loading-info").show();
        $('#meal-idea-review-form').attr('action', baseUrl + action).submit();
    }
}
</script>