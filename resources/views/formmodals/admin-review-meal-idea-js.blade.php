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
    $("#modal").modal();
}

function submitMealIdeaReview (status) {
    $('#new-status').val(status);
    $('#meal-idea-review-form').submit();
}
</script>