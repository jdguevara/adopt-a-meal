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

    resetValidation(inputIds);
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

function simpleJQueryValidation(event, validation_id, regex) {
    if($(event).val()) {
        var checkRegex = regex == undefined || regex.test($(event).val());
        if (checkRegex) {
            $(validation_id).addClass('hidden');
            $(validation_id).addClass('valid');
            return;
        }
    }
    $(validation_id).removeClass('hidden');
    $(validation_id).removeClass('valid');
}

function simpleJQueryValidity(validation_id) {
    if(!($(validation_id).hasClass('valid'))) {
        $(validation_id).removeClass('hidden');
        return false;
    } else {
        return true;
    }
}

function resetValidation(inputIds){
    $.each(inputIds, function( index, value) {
        $(value + '-validation').addClass('hidden');
        $(value + '-validation').removeClass('valid');
        simpleJQueryValidation($(value), value + '-validation');
    });
}
</script>