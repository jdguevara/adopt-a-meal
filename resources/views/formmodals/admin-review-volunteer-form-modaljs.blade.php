<script>
function loadAdminReviewVolunteerFormModal (eventId) {
    // find the event in our events list
    var event = volunteerForms.find(function(event) { return event.id == eventId; });

    // open the modal with event info
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

function submitAdminReviewVolunteerForm (approval) {
    // send the form, value set in jquery is async apparently?
    $('#approve-event').val(approval);
    $('#event-form').submit();
}
</script>