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
                        <div class="form-group{{ Form::hasError('setting.mail_driver') }} setting.mail_driver">
                            {!! Form::label('mail_driver', trans('general.mail_driver'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[mail_driver]', array('smtp' => 'smtp',
                                                                'mail' => 'mail', 
                                                                'sendmail' => 'sendmail', 
                                                                'mailgun' => 'mailgun', 
                                                                'mandrill' => 'mandrill', 
                                                                'ses' => 'ses', 
                                                                'sparkpost' => 'sparkpost', 
                                                                'log' => 'log'), isset($data['mail_driver']) ? $data['mail_driver'] : null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('setting.mail_driver') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_host') }} setting.mail_host">
                            {!! Form::label('mail_host', trans('general.mail_host').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_host]', isset($data['mail_host']) ? $data['mail_host'] : null, ['class' => 'form-control', 'placeholder' => trans('general.mail_host')]) !!}
                                {!! Form::errorMsg('setting.mail_host') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_port') }} setting.mail_port">
                            {!! Form::label('mail_port', trans('general.mail_port'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[mail_port]', array('25' => '25',
                                                                '465' => '465', 
                                                                '587' => '587', 
                                                                '2525' => '2525'), isset($data['mail_port']) ? $data['mail_port'] : null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('setting.mail_port') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_username') }} setting.mail_username">
                            {!! Form::label('mail_username', trans('general.mail_username').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_username]', isset($data['mail_username']) ? $data['mail_username'] : null, ['class' => 'form-control', 'placeholder' => trans('general.mail_username')]) !!}
                                {!! Form::errorMsg('setting.mail_username') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_password') }} setting.mail_password">
                            {!! Form::label('mail_password', trans('general.mail_password').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_password]', isset($data['mail_password']) ? $data['mail_password'] : null, ['class' => 'form-control', 'placeholder' => trans('general.mail_password')]) !!}
                                {!! Form::errorMsg('setting.mail_password') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_name') }} setting.mail_name">
                            {!! Form::label('mail_name', trans('general.mail_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_name]', isset($data['mail_name']) ? $data['mail_name'] : null, ['class' => 'form-control', 'placeholder' => trans('general.mail_name')]) !!}
                                {!! Form::errorMsg('setting.mail_name') !!}
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