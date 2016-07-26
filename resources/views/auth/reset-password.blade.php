@extends('layout.backend.admin.auth.auth_template')

@section('content')
    <p class="login-box-msg">Submit your email to reset password</p>
    @include('flash::message')
    {!! Form::open($form) !!}
        <div class="form-group{{ Form::hasError('email') }} has-feedback">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! Form::errorMsg('email') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                &nbsp;
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Reset', ['class' => 'btn btn-primary btn-block', 'Reset']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <a href="{!! route('admin-login') !!}">Back to Login</a>
@endsection