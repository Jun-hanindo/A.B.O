@extends('backend.auth-template')

@section('content')
    <p class="login-box-msg">Type your new password</p>
    @include('flash::message')
    {!! Form::open($form) !!}
        {!! Form::hidden('id', $data['id']) !!}
        {!! Form::hidden('code', $data['code']) !!}
        <div class="form-group{{ Form::hasError('password') }} has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="form-group{{ Form::hasError('password_confirmation') }} has-feedback">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password_confirmation') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                &nbsp;
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Change', ['class' => 'btn btn-primary btn-block', 'Change']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection