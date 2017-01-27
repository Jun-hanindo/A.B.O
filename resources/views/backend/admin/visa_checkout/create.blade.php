@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.visa_checkout') }} - {{ trans('backend/general.add') }} {{ trans('backend/general.visa_checkout') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.add') }} {{ trans('backend/general.visa_checkout') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-visa-checkout'), 'files'=>'true','method'=>'POST','id'=>'form-visa_checkout', 'class' => "form-horizontal")) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="form-group{{ Form::hasError('title') }} title">
                            {!! Form::label('title', trans('backend/general.title').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('title', old('title'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.title')]) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('banner_image') }} banner_image">
                            <label for="banner_image" class="col-sm-3 control-label">{{ trans('backend/general.banner_image').' *' }} <br>(2280px x 200px)</label>
                            (Max. size 1 mb)
                            <div class="col-sm-5">
                                <input id="banner_image" name="banner_image" class="form-control image" data-name="banner_image" type="file" value="">
                                {!! Form::errorMsg('banner_image') !!}
                            </div>
                        </div>
                        <div class="form-group preview" id="div-preview_banner_image" data-name="banner_image" style="display:none">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <img src="" name="preview" id="preview_banner_image" height="50%" width="50%">
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('banner_image_mobile') }} banner_image_mobile">
                            <label for="banner_image_mobile" class="col-sm-3 control-label">{{ trans('backend/general.banner_image_mobile').' *' }} <br>(750px x 270px)</label>
                            (Max. size 1 mb)
                            <div class="col-sm-5">
                                <input id="banner_image_mobile" name="banner_image_mobile" class="form-control image" data-name="banner_image_mobile" type="file" value="">
                                {!! Form::errorMsg('banner_image_mobile') !!}
                            </div>
                        </div>
                        <div class="form-group preview" id="div-preview_banner_image_mobile" data-name="banner_image_mobile" style="display:none">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <img src="" name="preview" id="preview_banner_image_mobile" height="50%" width="50%">
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('link') }} link">
                            {!! Form::label('link', trans('backend/general.link').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('link', old('link'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.link')]) !!}
                                {!! Form::errorMsg('link') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('background_color') }} background_color">
                            {!! Form::label('background_color', trans('backend/general.background_color'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-3">
                                {!! Form::text('background_color', old('background_color'), ['class' => 'form-control col-sm-4 colorpicker','maxlength'=>'1000', 'placeholder' => trans('backend/general.background_color')]) !!}
                                {!! Form::errorMsg('background_color') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                        <a href="{{ route('admin-index-visa-checkout') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.visa_checkout.script.create_script')