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
                                {!! Form::select('setting[language]', array('default' => 'Default'), null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('language') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('currency') }} currency">
                            {!! Form::label('currency', trans('general.currency').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[currency]', array('default' => 'Default'), null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('currency') !!}
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