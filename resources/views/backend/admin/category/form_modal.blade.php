    <div class="modal fade" id="modal-form-cat" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="ModalLabel"><span id="title-create">{{ trans('backend/general.create_new') }}</span><span id="title-update" style="display:none">{{ trans('backend/general.edit') }}</span></h4>
                </div>
                <div class="modal-body">
                    <div class="error-modal-cat"></div>
                    <form id="form-cat">
                        <input type="hidden" name="id" class="form-control" id="id-cat">
                        <div class="form-group name-cat">
                            <label for="event" class="control-label">{{ trans('backend/general.name') }} *</label>
                            {!! Form::text('name', old('name'), array('id' => 'name-cat', 'class' => 'form-control')) !!}
                            {!! Form::errorMsg('name') !!}
                        </div>
                        <div class="form-group icon">
                            <label for="event" class="control-label">{{ trans('backend/general.icon') }} *</label>
                            <select name="icon" id="icon-cat" class="form-control selectpicker" data-live-search="true">
                                @if(!empty($icons))
                                    @foreach ($icons as $icon)
                                        <optgroup label="{!! $icon['name'] !!}">
                                            @if (isset($icon['child']))
                                                @foreach($icon['child'] as $child)
                                                    <option value="{!! $child['name'] !!}" data-icon="fa fa-{!! $child['name'] !!}">icon-{!! $child['name'] !!}</option>
                                                @endforeach
                                            @endif
                                    @endforeach
                                @endif
                            </select>
                            {!! Form::errorMsg('icon') !!}
                        </div>
                        <div class="form-group description-cat">
                            <label for="event" class="control-label">{{ trans('backend/general.description') }} *</label>
                            {!! Form::textarea('description', old('description'), array('id' => 'description-cat', 'class' => 'form-control tinymce')) !!}
                            {!! Form::errorMsg('description') !!}
                        </div>
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="button_save-cat" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
                    <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}" style="display:none">{{ trans('backend/general.button_update') }}</button>
                </div>
            </div>
        </div>
    </div>