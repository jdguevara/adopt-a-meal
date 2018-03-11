<script>
function loadVolunteerFormModal(calEvent) {
    // clear form fields from previous events
    $("#volunteer-form").trigger("reset");
    resetVolunteerFormValidation(validationIds);

    var eventTitle = (calEvent.title && calEvent.title.length > 0) ?
    calEvent.title : "Volunteer For Event";

    $('#title').text(eventTitle);
    $('#event-id').val(calEvent.id);
    $('#event-time').val(calEvent.start);
    $('#event-date').val(calEvent.start.format('MMMM Do YYYY'));
    $('#event-title').val(eventTitle);
    $("#volunteer-modal").modal();
}

var validationIds = ['#organization_name_validation', '#email_validation', '#phone_validation', '#meal_description_validation'];

function setupVolunteerFormValidation() {
    $('#organization_name').on('input', function () {
        simpleJQueryValidation(this, '#organization_name_validation');
    });
    $('#email').on('input', function () {
        simpleJQueryValidation(this, '#email_validation', new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/));
    });
    $('#phone').on('input', function () {
        simpleJQueryValidation(this, '#phone_validation', new RegExp(/^([0-9]{10})|(\\(\\d{3}\\) \\d{3}-\\d{4})$/));
    });
    $('#meal_description').on('input', function () {
        simpleJQueryValidation(this, '#meal_description_validation');
    });
}

function submitVolunteerForm() {
    var $volunteerForm = $('#volunteer-form');

    var valid = true;
    $.each(validationIds, function(index, value) {
        valid = simpleJQueryValidity(value);
    });
    if(valid) {
        $("#inputs").hide();
        $("#input-buttons").hide();
        $("#loading-info").show();
        $volunteerForm.submit();
    }
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

function simpleJQueryValidity(validation_id) {
    if(!($(validation_id).hasClass('valid')) ) {
        $(validation_id).removeClass('hidden');
        $(validation_id).removeClass('valid');
        return false;
    } else {
        return true;
    }
}

function resetValidation(validationIds){
    $.each(validationIds, function( index, value) {
        $(value).addClass('hidden');
        $(value).removeClass('valid');
    });
}
</script>