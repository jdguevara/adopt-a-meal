<script>
function loadAdminReviewVolunteerFormModal (event) {
    $("#title").text(event.title);
    $('#meal-description').val(event.meal_description);
    $('#organization-name').val(event.organization_name);
    $('#event-date-time').val(event.event_date_time);
    $('#email').val(event.email);
    $('#notes').val(event.notes);
    $('#phone').val(event.phone);
    $('#paper-goods').val(event.paper_goods == 1 ? "Yes" : "No");
    $('#open-event-id').val(event.open_event_id);
    $('#volunteer-id').val(event.id);
    $("#event-modal").modal();
}

function submitAdminReviewVolunteerForm (submit) {
    console.log(submit);
    if(submit == 1 || !submit){ 
        $('#approve-event').val(submit);
        $('#event-form').submit();
    }
    else if(submit == 2){
        $('#paper-goods').val($('#paper-goods').val().toLowerCase() == "yes" ? 1 : 0);
        $('#event-form').submit();
    }
    // else{
    //     console.log("cancel event");
    // }
}
</script>