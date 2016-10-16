@extends('layout.backend.admin.master.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Sign in to TixTrack</h3>
                </div>
                {!! Form::open(array('url' => route('admin-tixtrack-login-post'),'method'=>'POST','id'=>'form-tixtrack')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group{{ Form::hasError('UserName') }} has-feedback">
                            {!! Form::text('UserName', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            {!! Form::errorMsg('UserName') !!}
                        </div>
                        <div class="form-group{{ Form::hasError('Password') }} has-feedback">
                            {!! Form::Password('Password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            {!! Form::errorMsg('Password') !!}
                        </div>
                        <div class="row">
                            {{-- <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        {!! Form::checkbox('remember_me') !!} Remember Me
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-xs-4">
                                {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block', 'Sign In']) !!}
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection