@extends('layout.backend.admin.master.master')

@section('title', 'Profile Settings')

{{-- @section('page-header', 'Profile <small>Settings</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-user"></i> Home</a></li>
        <li class="active">Profile Settings</li>
    </ol>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-profile" data-toggle="tab">Profile</a></li>
                    <li><a href="#tab-password" data-toggle="tab">Password</a></li>
                </ul>
                <div class="tab-content">
                    @include('flash::message')
                    <div class="tab-pane active" id="tab-profile">
                        {!! Form::modelHorizontal($user, $formProfile) !!}
                            @if ($user['avatar'] && file_exists(avatar_path($user['avatar'])))
                                <div class="form-group">
                                    <div class="col-sm-12" align="center">
                                        <img src="{!! link_to_avatar($user['avatar']) !!}" width="120" class="img-circle img-responsive">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group{{ Form::hasError('avatar') }}">
                                {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('avatar') !!}
                                    {!! Form::errorMsg('avatar') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('email') }}">
                                {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('email') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('first_name') }}">
                                {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('first_name') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('last_name') }}">
                                {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('last_name') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('skin', 'Layout Skin', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('skin', $skins, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="tab-password">
                        {!! Form::modelHorizontal([], $formPassword) !!}
                            <div class="form-group{{ Form::hasError('old_password') }}">
                                {!! Form::label('old_password', 'Old Password', ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('old_password', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('old_password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password') }}">
                                {!! Form::label('password', 'New Password', ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password_confirmation') }}">
                                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('password_confirmation') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection