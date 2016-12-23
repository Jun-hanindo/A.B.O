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
                        <div class="form-group icon-cat icon_image-cat btn-switch full-width pull-left">
                            <label for="event" class="control-label">{{ trans('backend/general.icon') }}{{-- <span id="icon_image-height" style="display:none;">(Height 80px)</span> --}}*</label><span id="icon_image-size" style="display:none;"> (Max. size 1 mb)</span>
                            <div class="col-md-12 no-padding">
                                {!! Form::checkbox('switch_icon', '1', true, ['class' => 'form-control pull-left switch_icon', 'data-animate' => 'false', 'data-on-text' => 'Icon',  'data-off-color' => 'success', 'data-off-text' => 'Image']) !!}
                                <div class="col-md-6">
                                    <div id="icon-div">
                                        <select name="icon" id="icon-cat" class="form-control selectpicker col-sm-8" data-live-search="true">
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
                                    <div id="icon_image-div" style="display:none;">
                                        <input id="icon_image-cat" name="icon_image" class="form-control image" data-name="icon_image" type="file" value="">
                                        {!! Form::errorMsg('icon_image') !!}
                                        <div class="form-group privew" id="div-preview_icon_image" data-name="icon_image" style="display:none">
                                            <img src="" name="preview" id="preview_icon_image" height="50%" width="50%">
                                        </div>
                                    </div>
                                </div>
                            </div>
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