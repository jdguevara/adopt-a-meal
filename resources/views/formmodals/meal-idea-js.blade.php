<script>
function loadMealIdeaModal() {
    // clear form fields from previous events
    $("#mealidea-modal").trigger("reset");

    $("#mealidea-modal").modal();
};

function submitMealIdea() {
    var $form = $('#mealidea-form');

    // if the form isn't valid, "click" the submit button which will force html5 validation
    // else, send it!
    if(!$form[0].checkValidity()) {
        $form.find(':submit').click();
    } else {    
        $("#inputs").hide();
        $("#loading-info").show();
        $form.submit();
    }
}

// Function that dynamicly adds fields
var i = 1;
$('#add').click(function(){
    i++;
    $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added ingredient input-group"><input type="text" name="ingredient[]" placeholder="Enter an Ingredient" class="form-control ingredient_list" /><span class="input-group-btn"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></span></div>');
});
$(document).on('click', '.btn_remove', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    if($('#dynamic_field').children().length < 2){
        i = 1;
    }
});
</script>