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
                        <div class="error"></div>
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