<script>

    var inputIds = ['#message-content'];
    var quill = null;

    function setupMessageValidation() {
        $('#message-content').on('input', function () {
            simpleJQueryValidation(this, '#message-content-validation');
        });
    }

    function loadMessageModal(elem) {

        var messageId = $(elem).attr("id");
        var messageContentId = "#message-" + messageId + "-content";
        var messageContent =  $(messageContentId).html();

        $("#old-message-content").html(messageContent);

        $("#message-modal").trigger("reset");
        resetJQueryValidation(inputIds);

        quill = null;
        $(".ql-toolbar").remove();

        $("#message-id").val(messageId);
        // $("#editor").text(messageContent);
        $("#modal").modal();

        quill = new Quill('#editor', {
            // modules: { toolbar: '#toolbar'},
            theme: 'snow'
        });


    }

    function submitMessage() {

        var text = quill.root.innerHTML;

        var messageContent = $('#message-content');
        messageContent.val(text);
        messageContent.trigger('input');

        var valid = true;
        $.each(inputIds, function(index, value) {
            valid = simpleJQueryValidity(value + '-validation') ? valid ? true : false : false;
        });
        if(valid) {
            $("#inputs").hide();
            $("#input-buttons").hide();
            $("#loading-info").show();
            $('#message-form').submit();
        }
    }

</script>