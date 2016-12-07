<div class="modal fade" id="modal-form-promotion" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel"><span id="title-create-promotion" style="display:none">{{ trans('backend/general.add_promotion') }}</span><span id="title-update-promotion" style="display:none">{{ trans('backend/general.edit') }}</span></h4>
            </div>
            <div class="modal-body">
                <div class="error-modal"></div>
                <form id="form-event-promotion">
                    <input type="hidden" name="id" class="form-control" id="promotion_id">
                    <div class="form-group{{ Form::hasError('title_promo') }} title_promo">
                        {!! Form::label('title_promo', trans('backend/general.title').' *') !!}
                        {!! Form::text('title_promo', old('title_promo'), ['id' => 'title_promo', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.title')]) !!}
                        {!! Form::errorMsg('title_promo') !!}
                    </div>
                    <div class="form-group{{ Form::hasError('description_promo') }} description_promo">
                        {!! Form::label('description_promo', trans('backend/general.description').' *') !!}
                        {!! Form::textarea('description_promo', old('description_promo'), ['id' => 'description_promo', 'class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.description')]) !!}
                        {!! Form::errorMsg('description_promo') !!}
                    </div>
                    <div class="form-group{{ Form::hasError('link_title_more_description') }} link_title_more_description">
                        {!! Form::label('link_title_more_description', trans('backend/general.link_title_more_description')) !!}
                        {!! Form::text('link_title_more_description', old('link_title_more_description'), ['id' => 'link_title_more_description', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.link_title_more_description')]) !!}
                        {!! Form::errorMsg('link_title_more_description') !!}
                    </div>
                    <div class="form-group{{ Form::hasError('more_description') }} more_description">
                        {!! Form::label('more_description', trans('backend/general.more_description')) !!}
                        {!! Form::textarea('more_description', old('more_description'), ['id' => 'more_description', 'class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.more_description')]) !!}
                        {!! Form::errorMsg('more_description') !!}
                    </div>

                    <div class="form-group{{ Form::hasError('discount') }} discount {{ Form::hasError('discount_nominal') }} discount_nominal full-width">
                        {!! Form::label('discount', trans('backend/general.discount'), array('class' => 'full-width ')) !!}
                        {!! Form::checkbox('discount_type', '1', null, ['class' => 'form-control pull-left discount_type-check', 'data-animate' => 'false', 'data-on-text' => 'Percent',  'data-off-color' => 'success', 'data-off-text' => 'Nominal']) !!}
                        <div id="discount-percent" class="pull-left col-sm-3">
                            <div class="input-group ">
                                {!! Form::text('discount', old('discount'), ['id' => 'discount', 'class' => 'form-control number-only percent','maxlength'=>'255', 'placeholder' => trans('backend/general.discount')]) !!}
                                <div class="input-group-addon">%</div>
                            </div>
                            {!! Form::errorMsg('discount') !!}
                        </div>
                        <div id="discount-nominal" class="pull-left col-sm-4" style="display:none">
                            <div class="input-group currency-value">
                                {!! Form::select('currency_id', $currencies, $currency_sel, array('data-default' => $currency_sel, 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
                                {!! Form::text('discount_nominal', old('discount_nominal'), ['id' => 'discount_nominal', 'class' => 'form-control number-only nominal','maxlength'=>'255', 'placeholder' => trans('backend/general.discount')]) !!}
                            </div>
                            {!! Form::errorMsg('discount_nominal') !!}
                        </div>
                    </div>

                    <div class="form-group{{ Form::hasError('discount_period') }} discount_period full-width">
                        {!! Form::label('discount_period', trans('backend/general.discount_period'), array('class' => 'full-width ')) !!}
                        <div class="col-sm-3 row form-group{{ Form::hasError('start_date') }} start_date">
                            {!! Form::text('start_date', old('start_date'), ['class' => 'form-control  datepicker', 'id' => 'start_date', 'maxlength'=>'255', 'placeholder' => trans('backend/general.start_date')]) !!}
                            {!! Form::errorMsg('start_date') !!}
                        </div>
                        {!! Form::label('to', trans('backend/general.to'), array('class' => 'col-sm-1 control-label')) !!}
                        <div class="col-sm-3 row form-group{{ Form::hasError('end_date') }} end_date">
                            {!! Form::text('end_date', old('end_date'), ['class' => 'form-control  datepicker', 'id' => 'end_date','maxlength'=>'255', 'placeholder' => trans('backend/general.end_date')]) !!}
                            {!! Form::errorMsg('end_date') !!}
                        </div>
                    </div>
                    <div class="form-group{{ Form::hasError('promotion_code') }} promotion_code full-width">
                        {!! Form::label('promotion_code', trans('backend/general.promotion_code'), array('class' => 'full-width ')) !!}
                        <div class="col-sm-4 row">
                            {!! Form::text('promotion_code', old('promotion_code'), ['id' => 'promotion_code', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.promotion_code')]) !!}
                            {!! Form::errorMsg('promotion_code') !!}
                        </div>
                    </div>
                    <div class="form-group{{ Form::hasError('promotion_logo') }} promotion_logo">
                        {!! Form::label('promotion_logo', trans('backend/general.promotion_logo').'(Max. 100px x 100px)') !!}
                        (Max. size 1 mb) <span id="span-promotion_logo"></span>
                        <input id="promotion_logo" name="promotion_logo" class="form-control image" data-name="promo_logo" type="file" value="">
                        {!! Form::errorMsg('promotion_logo') !!}
                    </div>
                    <div class="form-group privew" id="div-preview_promo_logo" data-name="promo_logo" style="display:none">
                        <img src="" name="preview" id="preview_promo_logo" height="20%" width="20%">
                    </div>
                    <div class="form-group{{ Form::hasError('promotion_banner') }} promotion_banner">
                        {!! Form::label('promotion_banner', trans('backend/general.promotion_banner').'(Max. 1440px x 400px)') !!}
                        (Max. size 1 mb) <span id="span-promotion_banner"></span>
                        <input id="promotion_banner" name="promotion_banner" class="form-control image" data-name="promo_banner" type="file" value="">
                        {!! Form::errorMsg('promotion_banner') !!}
                    </div>
                    <div class="form-group privew" id="div-preview_promo_banner" data-name="promo_banner" style="display:none">
                        <img src="" name="preview" id="preview_promo_banner" height="20%" width="20%">
                    </div>
                    <div class="form-group{{ Form::hasError('image_link') }} image_link">
                        {!! Form::label('image_link', trans('backend/general.image_link')) !!}
                        {!! Form::text('image_link', old('image_link'), ['id' => 'image_link', 'class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.image_link')]) !!}
                        {!! Form::errorMsg('image_link') !!}
                    </div>
                    <div class="form-group{{ Form::hasError('category') }} category">
                        {!! Form::label('category', trans('backend/general.category')) !!}
                        {!! Form::select('category', array('discounts' => 'Discounts',
                                                        'lucky-draws' => 'Lucky Draws', 
                                                        'early-bird' => 'Early Bird'), old('category'), ['class' => 'form-control category', 'id' => 'category']) !!}
                        {!! Form::errorMsg('category') !!}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="button_save_promotion" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
                <button type="button" id="button_update_promotion" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}">{{ trans('backend/general.button_update') }}</button>
            </div>
        </div>
    </div>
</div>