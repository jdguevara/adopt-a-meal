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
    $('#confirmed-event-id').val(event.confirmed_event_id)
    $('#volunteer-id').val(event.id);
    $("#event-modal").modal();
}

function submitAdminReviewVolunteerForm (submit) {
    $('#approve-event').val(submit);
    if(submit == 1 || !submit){ 
        $('#event-form').submit();
    }
    else if(submit == 2){
        $('#event-form').submit();
    }
    else{
        console.log("cancel event");
    }
}
</script>