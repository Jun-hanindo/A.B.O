@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.settings') }} - {{ trans('general.edit') }} {{ trans('general.setting') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.setting') }}</h3>
                </div>

                {!! Form::open(array('url' => route('admin-update-setting'),'method'=>'POST','id'=>'form-setting', 'class' => "form-horizontal")) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group">
                            {!! Form::label('language', trans('general.language'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[language]', $language, isset($data['language']) ? $data['language'] : null, ['class' => 'form-control']) !!}
                                
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('currency', trans('general.currency'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[currency]', $currencies, isset($data['currency']) ? $data['currency'] : null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('facebook') }} facebook">
                            {!! Form::label('facebook', trans('general.facebook'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[facebook]', isset($data['facebook']) ? $data['facebook'] : null, ['class' => 'form-control', 'placeholder' => trans('general.facebook')]) !!}
                                {!! Form::errorMsg('facebook') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('google_play') }} google_play">
                            {!! Form::label('google_play', trans('general.google_play'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[google_play]', isset($data['google_play']) ? $data['google_play'] : null, ['class' => 'form-control', 'placeholder' => trans('general.google_play')]) !!}
                                {!! Form::errorMsg('google_play') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('apple_store') }} apple_store">
                            {!! Form::label('apple_store', trans('general.apple_store'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[apple_store]', isset($data['apple_store']) ? $data['apple_store'] : null, ['class' => 'form-control', 'placeholder' => trans('general.apple_store')]) !!}
                                {!! Form::errorMsg('apple_store') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.office_name') }} setting.office_name">
                            {!! Form::label('office_name', trans('general.office_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[office_name]', isset($data['office_name']) ? $data['office_name'] : null, ['class' => 'form-control', 'placeholder' => trans('general.office_name')]) !!}
                                {!! Form::errorMsg('setting.office_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.office_address') }} setting.office_address">
                            {!! Form::label('office_address', trans('general.office_address').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('setting[office_address]', isset($data['office_address']) ? $data['office_address'] : null, ['class' => 'form-control tinymce', 'placeholder' => trans('general.office_address')]) !!}
                                {!! Form::errorMsg('setting.office_address') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.gmap_link') }} setting.gmap_link">
                            {!! Form::label('gmap_link', trans('general.gmap_link').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[gmap_link]', isset($data['gmap_link']) ? $data['gmap_link'] : null, ['class' => 'form-control', 'placeholder' => trans('general.gmap_link')]) !!}
                                {!! Form::errorMsg('setting.gmap_link') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.office_operating_hours') }} setting.office_operating_hours">
                            {!! Form::label('office_operating_hours', trans('general.office_operating_hours').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[office_operating_hours]', isset($data['office_operating_hours']) ? $data['office_operating_hours'] : null, ['class' => 'form-control', 'placeholder' => trans('general.office_operating_hours')]) !!}
                                {!! Form::errorMsg('setting.office_operating_hours') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.hotline') }} setting.hotline">
                            {!! Form::label('hotline', trans('general.hotline').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[hotline]', isset($data['hotline']) ? $data['hotline'] : null, ['class' => 'form-control', 'placeholder' => trans('general.hotline')]) !!}
                                {!! Form::errorMsg('setting.hotline') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.hotline_operating_hours') }} setting.hotline_operating_hours">
                            {!! Form::label('hotline_operating_hours', trans('general.hotline_operating_hours').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[hotline_operating_hours]', isset($data['hotline_operating_hours']) ? $data['hotline_operating_hours'] : null, ['class' => 'form-control', 'placeholder' => trans('general.hotline_operating_hours')]) !!}
                                {!! Form::errorMsg('setting.hotline_operating_hours') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.purpleclick_head') }} setting.purpleclick_head">
                            {!! Form::label('purpleclick_head', 'Purpleclick (<head>) *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('setting[purpleclick_head]', isset($data['purpleclick_head']) ? $data['purpleclick_head'] : null, ['class' => 'form-control', 'placeholder' => 'Purpleclick (<head>)']) !!}
                                {!! Form::errorMsg('setting.purpleclick_head') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.purpleclick_body') }} setting.purpleclick_body">
                            {!! Form::label('purpleclick_body', 'Purpleclick (<body>) *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('setting[purpleclick_body]', isset($data['purpleclick_body']) ? $data['purpleclick_body'] : null, ['class' => 'form-control', 'placeholder' => 'Purpleclick (<body>)']) !!}
                                {!! Form::errorMsg('setting.purpleclick_body') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.google_analytics') }} setting.google_analytics">
                            {!! Form::label('google_analytics', 'Google Analytics *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('setting[google_analytics]', isset($data['google_analytics']) ? $data['google_analytics'] : null, ['class' => 'form-control', 'placeholder' => 'Google Analytics']) !!}
                                {!! Form::errorMsg('setting.google_analytics') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.limit_record') }} setting.limit_record">
                            {!! Form::label('limit_record', trans('general.limit_record').' ('.trans('general.trail').' & '.trans('general.system_log').') *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('setting[limit_record]', array('0' => 'All',
                                                                '1000' => '1000', 
                                                                '5000' => '5000', 
                                                                '10000' => '10000', 
                                                                '50000' => '50000', 
                                                                '100000' => '100000'), isset($data['limit_record']) ? $data['limit_record'] : null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('setting.limit_record') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-setting') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_publish') }}" id="button_submit">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.setting.script.form_script')