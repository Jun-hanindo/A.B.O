@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.promotions') }} - {{ trans('backend/general.add') }} {{ trans('backend/general.promotion') }}
@endsection

@section('header')

    <style>
        #start_date, #end_date{
            border-radius: 0;
        }
        #discount-percent, #discount-nominal{
            margin-left: 10px;
        }
        .bootstrap-switch{
            float: left;
        }
        img[src=""] {
            display: none;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.add') }} {{ trans('backend/general.promotion') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-promotion'),'files'=>'true','method'=>'POST','id'=>'form-promotion')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="col-md-9">
                            <div class="form-group{{ Form::hasError('title_promo') }} title_promo">
                                {!! Form::label('title_promo', trans('backend/general.title').' *') !!}
                                {!! Form::text('title_promo', old('title_promo'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.title')]) !!}
                                {!! Form::errorMsg('title_promo') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description_promo') }} description_promo">
                                {!! Form::label('description_promo', trans('backend/general.description').' *') !!}
                                {!! Form::textarea('description_promo', old('description_promo'), ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.description')]) !!}
                                {!! Form::errorMsg('description_promo') !!}
                            </div>


                            <div class="form-group{{ Form::hasError('discount') }} discount {{ Form::hasError('discount_nominal') }} discount_nominal full-width">
                                {!! Form::label('discount', trans('backend/general.discount'), array('class' => 'full-width ')) !!}
                                {!! Form::checkbox('discount_type', '1', true, ['class' => 'form-control pull-left discount_type-check', 'data-animate' => 'false', 'data-on-text' => 'Percent',  'data-off-color' => 'success', 'data-off-text' => 'Nominal']) !!}
                                <div id="discount-percent" class="pull-left col-sm-3">
                                    <div class="input-group ">
                                        {!! Form::text('discount', old('discount'), ['id' => 'discount', 'class' => 'form-control number-only percent','maxlength'=>'255', 'placeholder' => trans('backend/general.discount')]) !!}
                                        <div class="input-group-addon">%</div>
                                    </div>
                                    {!! Form::errorMsg('discount') !!}
                                </div>
                                <div id="discount-nominal" class="pull-left col-sm-4" style="display:none">
                                    <div class="input-group currency-value">
                                        {!! Form::select('currency_id', $data['currencies'], $data['currency_sel'], array('class' => 'form-control','data-option' => old('currency_id'))) !!}
                                        {!! Form::text('discount_nominal', old('discount_nominal'), ['id' => 'discount_nominal', 'class' => 'form-control number-only nominal','maxlength'=>'255', 'placeholder' => trans('backend/general.discount')]) !!}
                                    </div>
                                    {!! Form::errorMsg('discount_nominal') !!}
                                </div>
                            </div>


                            <div class="form-group{{ Form::hasError('discount_period') }} discount_period full-width">
                                {!! Form::label('discount_period', trans('backend/general.discount_period'), array('class' => 'full-width ')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('start_date') }}">
                                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control  datepicker', 'id' => 'start_date', 'maxlength'=>'255', 'placeholder' => trans('backend/general.start_date')]) !!}
                                    {!! Form::errorMsg('start_date') !!}
                                </div>
                                {!! Form::label('to', trans('backend/general.to'), array('class' => 'col-sm-1 control-label')) !!}
                                <div class="col-sm-3 row form-group{{ Form::hasError('end_date') }}">
                                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control  datepicker', 'id' => 'end_date','maxlength'=>'255', 'placeholder' => trans('backend/general.end_date')]) !!}
                                    {!! Form::errorMsg('end_date') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('promotion_code') }} promotion_code full-width">
                                {!! Form::label('promotion_code', trans('backend/general.promotion_code'), array('class' => 'full-width ')) !!}
                                <div class="col-sm-4 row">
                                    {!! Form::text('promotion_code', old('promotion_code'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.promotion_code')]) !!}
                                    {!! Form::errorMsg('promotion_code') !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('promotion_logo') }} promotion_logo">
                                {!! Form::label('promotion_logo', trans('backend/general.promotion_logo').'(Max. 100px x 100px)') !!}
                                (Max. size 1 mb)
                                <input id="promotion_logo" name="promotion_logo" class="form-control image" data-name="promo_logo" type="file" value="">
                                {!! Form::errorMsg('promotion_logo') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_promo_logo" data-name="promo_logo" style="display:none">
                                <img src="" name="preview" id="preview_promo_logo" height="20%" width="20%">
                            </div>
                            <div class="form-group{{ Form::hasError('promotion_banner') }} promotion_banner">
                                {!! Form::label('promotion_banner', trans('backend/general.promotion_banner').'(Max. 1440px x 400px)') !!}
                                (Max. size 1 mb)
                                <input id="promotion_banner" name="promotion_banner" class="form-control image" data-name="promo_banner" type="file" value="">
                                {!! Form::errorMsg('promotion_banner') !!}
                            </div>
                            <div class="form-group privew" id="div-preview_promo_banner" data-name="promo_banner" style="display:none">
                                <img src="" name="preview" id="preview_promo_banner" height="20%" width="20%">
                            </div>
                            <div class="form-group{{ Form::hasError('image_link') }} image_link">
                                {!! Form::label('image_link', trans('backend/general.image_link')) !!}
                                {!! Form::text('image_link', old('image_link'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.image_link')]) !!}
                                {!! Form::errorMsg('image_link') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('category') }} category">
                                {!! Form::label('category', trans('backend/general.category')) !!}
                                {!! Form::select('category', array('discounts' => 'Discounts',
                                                                'lucky-draws' => 'Lucky Draws', 
                                                                'early-bird' => 'Early Bird'), old('category'), ['class' => 'form-control category', 'id' => 'category']) !!}
                                {!! Form::errorMsg('category') !!}
                            </div>
                            <div class="box-footer">
                                <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                                <a href="{{ route('admin-index-promotion') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.promotion.script.create_script')