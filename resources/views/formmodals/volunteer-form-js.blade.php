<script>
function loadVolunteerFormModal(calEvent) {
    // clear form fields from previous events
    $("#volunteer-form").trigger("reset");
    resetVolunteerFormValidation();

    var eventTitle = (calEvent.title && calEvent.title.length > 0) ?
    calEvent.title : "Volunteer For Event";

    $('#title').text(eventTitle);
    $('#event-id').val(calEvent.id);
    $('#event-time').val(calEvent.start);
    $('#event-date').val(calEvent.start.format('MMMM Do YYYY'));
    $('#event-title').val(eventTitle);
    $("#volunteer-modal").modal();
}

function setupVolunteerFormValidation() {
    $('#organization_name').on('input', function () {
        if ($(this).val()) {
            $('#organization_name_validation').addClass('hidden');
            $('#organization_name_validation').addClass('valid');
        } else {
            $('#organization_name_validation').removeClass('hidden');
            $('#organization_name_validation').removeClass('valid');
        }
    });
    $('#email').on('input',  function() {
        var regExEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        var checkEmail = regExEmail.test($(this).val());
        if (checkEmail) {
            $('#email_validation').addClass('hidden');
            $('#email_validation').addClass('valid');
        } else {
            $('#email_validation').removeClass('hidden')
            $('#email_validation').removeClass('valid');
        }
    });
    $('#phone').on('input', function(){
        var regExPhone =/^([0-9]{10})|(\\(\\d{3}\\) \\d{3}-\\d{4})$/;
        var checkPhone = regExPhone.test($(this).val());
        if(checkPhone) {
            $('#phone_validation').addClass('hidden');
            $('#phone_validation').addClass('valid');
        } else {
            $('#phone_validation').removeClass('hidden');
            $('#phone_validation').removeClass('valid');
        }
    });

    $('#meal_description').on('input', function(){
        if($(this).val()){
            $('#meal_description_validation').addClass('hidden');
            $('#meal_description_validation').addClass('valid');

        } else {

            $('#meal_description_validation').removeClass('hidden');
            $('#meal_description_validation').removeClass('valid');
        }
    });
}

function resetVolunteerFormValidation(){
    $('#phone_validation').addClass('hidden');
    $('#phone_validation').removeClass('valid');
    $('#email_validation').addClass('hidden');
    $('#email_validation').removeClass('valid');
    $('#organization_name_validation').addClass('hidden');
    $('#organization_name_validation').removeClass('valid');
    $('#meal_description_validation').addClass('hidden');
    $('#meal_description_validation').removeClass('valid');
}

function submitVolunteerForm() {

    var $volunteerForm = $('#volunteer-form');

    // if the form isn't valid, "click" the submit button which will force html5 validation
    // else, send it!

    //This is if they've clicked on the volunteer button
    if(!($('#phone_validation').hasClass('valid')
        && $('#email_validation').hasClass('valid')
        && $('#organization_name_validation').hasClass('valid')
        && $volunteerForm[0].checkValidity())) {

        if(! $('#phone_validation').hasClass('valid')) {
            $('#phone_validation').removeClass('hidden');
            $('#phone_validation').removeClass('valid');
        }
        if(! $('#organization_name_validation').hasClass('valid')){
            $('#organization_name_validation').removeClass('hidden');
            $('#organization_name_validation').removeClass('valid');
        }
        if(! $('#email_validation').hasClass('valid')){
            $('#email_validation').removeClass('hidden');
            $('#email_validation').removeClass('valid');
        }
        if(! $('#meal_description_validation').hasClass('valid')){
            $('#meal_description_validation').removeClass('hidden');
            $('#meal_description_validation').removeClass('valid');
        }
        if(!$volunteerForm[0].checkValidity()) {
            $volunteerForm.find(':submit').click();
        }

    } else {
            $("#inputs").hide();
            $("#input-buttons").hide();
            $("#loading-info").show();
            $volunteerForm.submit();
    }
}

</script>