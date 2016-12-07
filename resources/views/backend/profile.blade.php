@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.profile_settings'))

{{-- @section('page-header', 'Profile <small>Settings</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-user"></i> Home</a></li>
        <li class="active">Profile Settings</li>
    </ol>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-profile" data-toggle="tab">{{ trans('backend/general.profile') }}</a></li>
                    <li><a href="#tab-password" data-toggle="tab">{{ trans('backend/general.password') }}</a></li>
                </ul>
                <div class="tab-content">
                    @include('flash::message')
                    <div class="tab-pane active" id="tab-profile">
                        {!! Form::modelHorizontal($user, $formProfile) !!}
                            @if ($user['avatar'])
                                <div class="form-group">
                                    <div class="col-sm-12" align="center">
                                        <img src="{!! file_url('avatars/'.$user['avatar'], env('FILESYSTEM_DEFAULT')) !!}" width="120" class="img-circle img-responsive">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group{{ Form::hasError('avatar') }}">
                                {!! Form::label('avatar', trans('backend/general.avatar'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::file('avatar') !!}
                                    {!! Form::errorMsg('avatar') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('email') }}">
                                {!! Form::label('email', trans('backend/general.email').' *', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.email')]) !!}
                                    {!! Form::errorMsg('email') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('first_name') }}">
                                {!! Form::label('first_name', trans('backend/general.first_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.first_name')]) !!}
                                    {!! Form::errorMsg('first_name') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('last_name') }}">
                                {!! Form::label('last_name', trans('backend/general.last_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.last_name')]) !!}
                                    {!! Form::errorMsg('last_name') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('phone') }}">
                                {!! Form::label('phone', trans('backend/general.cellphone').' *', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.cellphone')]) !!}
                                    {!! Form::errorMsg('phone') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('address') }}">
                                {!! Form::label('address', trans('backend/general.address').' *', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.address')]) !!}
                                    {!! Form::errorMsg('address') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('skin', trans('backend/general.layout_skin'), ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('skin', $skins, null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit(trans('backend/general.button_save'), ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="tab-password">
                        {!! Form::modelHorizontal([], $formPassword) !!}
                            <div class="form-group{{ Form::hasError('old_password') }}">
                                {!! Form::label('old_password', trans('backend/general.old_password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => trans('backend/general.old_password')]) !!}
                                    {!! Form::errorMsg('old_password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password') }}">
                                {!! Form::label('password', trans('backend/general.new_password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('backend/general.new_password')]) !!}
                                    {!! Form::errorMsg('password') !!}
                                </div>
                            </div>
                            <div class="form-group{{ Form::hasError('password_confirmation') }}">
                                {!! Form::label('password_confirmation', trans('backend/general.confirm_password'), ['class' => 'col-sm-4 control-label']) !!}
                                <div class="col-sm-8">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('backend/general.confirm_password')]) !!}
                                    {!! Form::errorMsg('password_confirmation') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    {!! Form::submit(trans('backend/general.button_save'), ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection