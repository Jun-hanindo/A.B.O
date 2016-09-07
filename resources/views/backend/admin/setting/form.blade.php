@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.settings') }} - {{ trans('general.edit') }} {{ trans('general.setting') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.setting') }}</h3>
                </div>

                {!! Form::open(array('url' => route('admin-update-setting'),'method'=>'POST','id'=>'form-setting', 'class' => "form-horizontal")) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group{{ Form::hasError('language') }} language">
                            {!! Form::label('language', trans('general.language').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[language]', array('english' => 'English',
                                                                'singapore' => 'Singapore', 
                                                                'malaysia' => 'Malaysia', 
                                                                'indonesia' => 'Indonesia'), isset($data['language']) ? $data['language'] : null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('language') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('currency') }} currency">
                            {!! Form::label('currency', trans('general.currency').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[currency]', array('AUD' => 'Australian Dollar',
                                                                    'BRL' => 'Brazilian Real', 
                                                                    'CAD' => 'Canadian Dollar', 
                                                                    'CZK' => 'Czech Koruna',
                                                                    'DKK' => 'Danish Krone',
                                                                    'EUR' => 'Euro', 
                                                                    'HKD' => 'Hong Kong Dollar', 
                                                                    'HUF' => 'Hungarian Forint',
                                                                    'ILS' => 'Israeli New Sheqel', 
                                                                    'IDR' => 'Indonesian Rupiah', 
                                                                    'JPY' => 'Japanese Yen',
                                                                    'MYR' => 'Malaysian Ringgit',
                                                                    'MXN' => 'Mexican Peso',
                                                                    'NOK' => 'Norwegian Krone',
                                                                    'NZD' => 'New Zealand Dollar',
                                                                    'PHP' => 'Philippine Peso',
                                                                    'PLN' => 'Polish Zloty',
                                                                    'GBP' => 'Pound Sterling',
                                                                    'SGD' => 'Singapore Dollar',
                                                                    'SEK' => 'Swedish Krona',
                                                                    'CHF' => 'Swiss Franc',
                                                                    'TWD' => 'Taiwan New Dollar',
                                                                    'THB' => 'Thai Baht',
                                                                    'TRY' => 'Turkish Lira',
                                                                    'USD' => 'U.S. Dollar'), isset($data['currency']) ? $data['currency'] : null, ['class' => 'form-control']) !!}
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
                        <div class="form-group{{ Form::hasError('office_name') }} office_name">
                            {!! Form::label('office_name', trans('general.office_name'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[office_name]', isset($data['office_name']) ? $data['office_name'] : null, ['class' => 'form-control', 'placeholder' => trans('general.office_name')]) !!}
                                {!! Form::errorMsg('office_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('office_address') }} office_address">
                            {!! Form::label('office_address', trans('general.office_address'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('setting[office_address]', isset($data['office_address']) ? $data['office_address'] : null, ['class' => 'form-control tinymce', 'placeholder' => trans('general.office_address')]) !!}
                                {!! Form::errorMsg('office_address') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('gmap_link') }} gmap_link">
                            {!! Form::label('gmap_link', trans('general.gmap_link'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[gmap_link]', isset($data['gmap_link']) ? $data['gmap_link'] : null, ['class' => 'form-control', 'placeholder' => trans('general.gmap_link')]) !!}
                                {!! Form::errorMsg('gmap_link') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('office_operating_hours') }} office_operating_hours">
                            {!! Form::label('office_operating_hours', trans('general.office_operating_hours'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[office_operating_hours]', isset($data['office_operating_hours']) ? $data['office_operating_hours'] : null, ['class' => 'form-control', 'placeholder' => trans('general.office_operating_hours')]) !!}
                                {!! Form::errorMsg('office_operating_hours') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('hotline') }} hotline">
                            {!! Form::label('hotline', trans('general.hotline'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[hotline]', isset($data['hotline']) ? $data['hotline'] : null, ['class' => 'form-control', 'placeholder' => trans('general.hotline')]) !!}
                                {!! Form::errorMsg('hotline') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('hotline_operating_hours') }} hotline_operating_hours">
                            {!! Form::label('hotline_operating_hours', trans('general.hotline_operating_hours'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[hotline_operating_hours]', isset($data['hotline_operating_hours']) ? $data['hotline_operating_hours'] : null, ['class' => 'form-control', 'placeholder' => trans('general.hotline_operating_hours')]) !!}
                                {!! Form::errorMsg('hotline_operating_hours') !!}
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
@include('backend.admin.setting.script.create_script')