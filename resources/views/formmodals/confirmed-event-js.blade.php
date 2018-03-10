<script>
function loadConfirmedEventModal(calEvent) {
    $("#confirmed-event-date").val(calEvent.start.format('MMMM Do YYYY'));
    $("#confirmed-description").val(calEvent.description);
    $("#confirmed-title").val(calEvent.title);
    $("#confirmed-event-modal").modal();
}
</script>