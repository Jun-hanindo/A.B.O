<div class="modal fade" id="modal-form-category" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalLabel"><span id="title-create-category" style="display:none">{{ trans('backend/general.add_schedule_and_price') }}</span><span id="title-update-category" style="display:none">{{ trans('backend/general.edit') }}</span></h4>
            </div>
            <div class="modal-body">
                <div class="error-modal"></div>
                <form class="form-horizontal" id="form-event-category">
                    <input type="hidden" name="id" class="form-control" id="category_id">
                    <div class="form-group additional_info">
                        {!! Form::label('additional_info', trans('backend/general.price_name').' *', array('class' => 'col-sm-3 control-label pull-left')) !!}
                        <div class="col-sm-9">
                            {!! Form::text('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5', 'placeholder' => trans('backend/general.price_name')]) !!}
                        </div>
                    </div>
                    <div class="form-group price">
                        {!! Form::label('price', trans('backend/general.price').' *', array('class' => 'col-sm-3 control-label pull-left')) !!}
                        <div class="col-sm-9 input-group currency-value">
                            {!! Form::select('currency_id', $currencies, $currency_sel, array('data-default' => $currency_sel, 'id' => 'currency_id', 'class' => 'form-control','data-option' => old('currency_id'))) !!}
                            {!! Form::text('price', old('price'), ['class' => 'form-control number-only','maxlength'=>'255']) !!}
                        </div>
                    </div>
                    <div class="form-group seat_color">
                        {!! Form::label('seat_color', trans('backend/general.seat_color'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                        <div class="col-sm-4">
                            {!! Form::text('seat_color', old('seat_color'), ['class' => 'form-control colorpicker', 'rows'=> '5', 'placeholder' => trans('backend/general.seat_color')]) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="col-sm-4  col-sm-offset-3">
                            {!! Form::select('price_cat', array('/person' => '/person'), old('role'), array('class' => 'form-control','data-option' => old('price_cat'))) !!}
                        </div>
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="button_save_category" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
                <button type="button" id="button_update_category" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}">{{ trans('backend/general.button_update') }}</button>
            </div>
        </div>
    </div>
</div>