@extends('layout.backend.admin.auth.auth_template')

@section('content')
    <p class="login-box-msg">Sign in to start your session</p>
    @include('flash::message')
    {!! Form::open($form) !!}
        <div class="form-group{{ Form::hasError('email') }} has-feedback">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! Form::errorMsg('email') !!}
        </div>
        <div class="form-group{{ Form::hasError('password') }} has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('remember_me') !!} Remember Me
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block', 'Sign In']) !!}
            </div>
        </div>
    {!! Form::close() !!}
    
    <a href="{!! route('admin-reset-password') !!}">Forgot Password?</a>
@endsection