@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.settings') }} - {{ trans('backend/general.edit') }} {{ trans('backend/general.setting') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.setting') }}</h3>
                </div>

                {!! Form::open(array('url' => route('admin-update-setting'),'method'=>'POST','id'=>'form-setting', 'class' => "form-horizontal")) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group{{ Form::hasError('setting.mail_driver') }} setting.mail_driver">
                            {!! Form::label('mail_driver', trans('backend/general.mail_driver'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[mail_driver]', array('smtp' => 'smtp',
                                                                'mail' => 'mail', 
                                                                'mailgun' => 'mailgun', 
                                                                'mandrill' => 'mandrill', 
                                                                'ses' => 'ses', 
                                                                'sparkpost' => 'sparkpost'), isset($data['mail_driver']) ? $data['mail_driver'] : null, ['class' => 'form-control', 'id' => 'mail_driver']) !!}
                                {!! Form::errorMsg('setting.mail_driver') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_host') }} setting.mail_host" id="div_mail_host">
                            {!! Form::label('mail_host', trans('backend/general.mail_host').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_host]', isset($data['mail_host']) ? $data['mail_host'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_host')]) !!}
                                {!! Form::errorMsg('setting.mail_host') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_port') }} setting.mail_port" id="div_mail_port">
                            {!! Form::label('mail_port', trans('backend/general.mail_port'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('setting[mail_port]', array('25' => '25',
                                                                '465' => '465', 
                                                                '587' => '587', 
                                                                '2525' => '2525'), isset($data['mail_port']) ? $data['mail_port'] : null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('setting.mail_port') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_username') }} setting.mail_username" id="div_mail_username">
                            {!! Form::label('mail_username', trans('backend/general.mail_username').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_username]', isset($data['mail_username']) ? $data['mail_username'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_username')]) !!}
                                {!! Form::errorMsg('setting.mail_username') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_password') }} setting.mail_password" id="div_mail_password">
                            {!! Form::label('mail_password', trans('backend/general.mail_password').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_password]', isset($data['mail_password']) ? $data['mail_password'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_password')]) !!}
                                {!! Form::errorMsg('setting.mail_password') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_encryption') }} setting.mail_encryption" id="div_mail_encryption">
                            {!! Form::label('mail_encryption', trans('backend/general.mail_encryption').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_encryption]', isset($data['mail_encryption']) ? $data['mail_encryption'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_encryption')]) !!}
                                {!! Form::errorMsg('setting.mail_encryption') !!}
                            </div>
                        </div>
                        {{-- <div class="form-group{{ Form::hasError('setting.mail_name') }} setting.mail_name" id="div_mail_name">
                            {!! Form::label('mail_name', trans('backend/general.mail_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_name]', isset($data['mail_name']) ? $data['mail_name'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_name')]) !!}
                                {!! Form::errorMsg('setting.mail_name') !!}
                            </div>
                        </div> --}}
                        <div class="form-group{{ Form::hasError('setting.mail_domain') }} setting.mail_domain" id="div_mail_domain">
                            {!! Form::label('mail_domain', trans('backend/general.mail_domain').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_domain]', isset($data['mail_domain']) ? $data['mail_domain'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_domain')]) !!}
                                {!! Form::errorMsg('setting.mail_domain') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_secret') }} setting.mail_secret" id="div_mail_secret">
                            {!! Form::label('mail_secret', trans('backend/general.mail_secret').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_secret]', isset($data['mail_secret']) ? $data['mail_secret'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_secret')]) !!}
                                {!! Form::errorMsg('setting.mail_secret') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_key') }} setting.mail_key" id="div_mail_key">
                            {!! Form::label('mail_key', trans('backend/general.mail_key').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_key]', isset($data['mail_key']) ? $data['mail_key'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_key')]) !!}
                                {!! Form::errorMsg('setting.mail_key') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.mail_region') }} setting.mail_region" id="div_mail_region">
                            {!! Form::label('mail_region', trans('backend/general.mail_region').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[mail_region]', isset($data['mail_region']) ? $data['mail_region'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.mail_region')]) !!}
                                {!! Form::errorMsg('setting.mail_region') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">&nbsp;
                        <a href="{{ route('admin-index-setting') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.setting.script.form_script')