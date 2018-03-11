<script>
function loadMealIdeaModal() {
    // clear form fields from previous events
    $("#mealidea-modal").trigger("reset");
    resetJQueryValidation(inputIds);

    $("#meal-title").val('');
    $('#instructions').val('');
    $('#description').val('');
    $('#email').val('');
    $('#name').val('');
    $('#external-link').val('');

    var ingredients = JSON.parse('[]');
    $('#ingredients').val(ingredients.join(', '));

    $("#meal-idea-modal").modal();
};

var inputIds = ['#meal-title', '#instructions', '#description', '#ingredients'];

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

function submitMealIdea() {
    var valid = true;
    $.each(inputIds, function(index, value) {
        valid = simpleJQueryValidity(value + '-validation') ? valid ? true : false : false;
    });
    if(valid) {
        $("#inputs").hide();
        $("#input-buttons").hide();
        $("#loading-info").show();
        $('#meal-idea-form').submit();
    }
}

// Function that dynamicly adds fields
var i = 1;
$('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added ingredient input-group"><input type="text" name="ingredient[]" placeholder="Enter an Ingredient" class="form-control ingredient_list" /><span class="input-group-btn"><button type="button" name="remove" id="'+i+'" class="btn btn-warning btn_remove">X</button></span></div>');
});
$(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    if($('#dynamic_field').children().length < 2){
        i = 1;
    }
});

</script>