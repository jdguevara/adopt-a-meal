<script>

    var inputIds = ['#message-content'];
    var quill = null;

    function setupMessageValidation() {
        $('#message-content').on('input', function () {
            simpleJQueryValidation(this, '#message-content-validation');
        });
    }

    function filter() {

        var items = $('li');
        var search = $('#search').val();

        items.forEach(function(item) {
           if(item.attr('id') === search)
        });

    }

    function loadMessageModal(elem) {

        var messageId = $(elem).attr("id");
        var messageContentId = "#message-" + messageId + "-content";
        var messageContent =  $(messageContentId).html();

        $("#message-modal").trigger("reset");
        resetJQueryValidation(inputIds);

        // reset quill by removing the toolbar html and garbage collecting it, bye!
        quill = null;
        $(".ql-toolbar").remove();

        // set the quill container's content to the rendered html of the old message
        $("#editor").html(messageContent);

        $("#message-id").val(messageId);
        $("#modal").modal();

        quill = new Quill('#editor', {
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