@extends('layout.backend.admin.auth.auth_template')
@section('content')
    <p class="login-box-msg">Sign Up</p>
    @include('errors.alert')
    {!! Form::open(array('url' => route('post-signup'), 'method' => 'POST')) !!}
        <div class="form-group{{ Form::hasError('email') }} has-feedback">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! Form::errorMsg('email') !!}
        </div>

        <div class="form-group{{ Form::hasError('username') }} has-feedback">
            {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            {!! Form::errorMsg('username') !!}
        </div>

        <div class="form-group{{ Form::hasError('password') }} has-feedback">
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="form-group{{ Form::hasError('password') }} has-feedback">
            {!! Form::password('password_confirmation', ['class' => 'form-control required', 'placeholder' => 'Re-Type Password']) !!}
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! Form::errorMsg('password') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        {!! Form::checkbox('term') !!} Term and Condition
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                {!! Form::submit('Sign Up', ['class' => 'btn btn-primary btn-block', 'Sign Up']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection