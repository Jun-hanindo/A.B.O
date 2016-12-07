<div id="delete-modal2" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('backend/general.confirmation') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('backend/general.confirmation_delete') }} <strong id="name"></strong> ?</p>
            </div>
            <div class="modal-footer">
                <a id="btn-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                <a id="btn-modal-continue" href="#" class="continue-delete btn btn-default" data-dismiss="modal">{{ trans('backend/general.button_continue') }}</a>
            </div>
        </div>
    </div>
</div>
