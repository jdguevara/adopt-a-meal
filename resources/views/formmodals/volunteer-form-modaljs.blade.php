<script>
function loadVolunteerFormModal(calEvent) {
    // clear form fields from previous events
    $("#volunteer-form").trigger("reset");
    resetJQueryValidation(validationIds);

    var eventTitle = (calEvent.title && calEvent.title.length > 0) ?
    calEvent.title : "Volunteer For Event";

    $('#title').text(eventTitle);
    $('#event-id').val(calEvent.id);
    $('#event-time').val(calEvent.start);
    $('#event-date').val(calEvent.start.format('MMMM Do YYYY'));
    $('#event-title').val(eventTitle);
    $("#volunteer-modal").modal();
}

var validationIds = ['#organization_name', '#email', '#phone', '#meal_description'];

function setupVolunteerFormValidation() {
    $('#organization_name').on('input', function () {
        simpleJQueryValidation(this, '#organization_name-validation');
    });
    $('#email').on('input', function () {
        simpleJQueryValidation(this, '#email-validation', new RegExp(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/));
    });
    $('#phone').on('input', function () {
        simpleJQueryValidation(this, '#phone-validation', new RegExp(/^([0-9]{10})|(\\(\\d{3}\\) \\d{3}-\\d{4})$/));
    });
    $('#meal_description').on('input', function () {
        simpleJQueryValidation(this, '#meal_description-validation');
    });
}

function submitVolunteerForm() {
    var $volunteerForm = $('#volunteer-form');

    var valid = true;
    $.each(validationIds, function(index, value) {
        valid = simpleJQueryValidity(value + '-validation') ? valid ? true : false : false;
    });
    if(valid) {
        $("#inputs").hide();
        $("#input-buttons").hide();
        $("#loading-info").show();
        $volunteerForm.submit();
    }
}
</script>