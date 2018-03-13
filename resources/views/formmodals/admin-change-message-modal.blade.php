<form id="message-form" method="POST" action="/admin/settings/update-message">

    {{ csrf_field() }}
    <div class="modal fade" id="modal" role="dialog">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">
                    <h3>Change Message</h3>
                </div>

                <!-- list of text field inputs and check boxes  -->
                <div class="modal-body">

                    <h3 id="message-title"></h3>

                    <div id="inputs" class="container-fluid message-inputs">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Message</span>
                                <input id="message-content" name="message-content" class="form-control" type="text" />
                                <div id="message-content-validation" class="hidden alert-danger">Required: Please enter message content</div>
                            </div>
                        </div>

                    </div>

                    <input id="message-id" name="id" type="text" hidden />
                    <!-- loading spinner -->
                    <div id="loading-info" class="loading-info" hidden>
                        <h3 class="text-light text-center">Submitting Message</h3>
                        <div id="loading-spinner" class="spinner">
                            <div class="dot1"></div>
                            <div class="dot2"></div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">

                    <div id="input-buttons" class="input-group pull-right">
                        <button id="update" type="button" class="btn btn-success" onClick="submitMessage();">
                            Update
                        </button>
                        <button id="cancel" type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

