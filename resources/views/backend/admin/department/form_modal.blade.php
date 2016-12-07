<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('backend/general.create_new') }} {{ trans('backend/general.department') }}</span><span id="title-update" style="display:none">{{ trans('backend/general.edit') }} {{ trans('backend/general.department') }}</span></h4>
            </div>
            <div class="modal-body">
                <div class="error-modal"></div>
                <form id="form">
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="form-group name">
                        <label for="event" class="control-label">{{ trans('backend/general.name') }} * </label>
                        {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                        {!! Form::errorMsg('name') !!}
                    </div>
                
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
                <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}">{{ trans('backend/general.button_update') }}</button>
            </div>
        </div>
    </div>
</div>