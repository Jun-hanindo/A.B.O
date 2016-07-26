@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.users') }} {{ trans('general.management') }} - {{ trans('general.create_new') }}
@endsection

@section('page-header')
    {{ trans('general.users') }} {{ trans('general.management') }} <small>{{trans('general.create_new')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-users') !!}">{{ trans('general.users') }} {{ trans('general.management') }}</a></li>
        <li class="active">{{ trans('general.create_new') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.create_new') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-users'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-users')) !!}
                    <div class="box-body">
                    <div class="error"></div>
                        <div class="form-group{{ Form::hasError('username') }} username">
                            {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label ']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('username', old('username'), array('id' => 'username', 'class' => 'form-control block-space','data-option' => old('username'),'maxlength'=>255)) !!}
                            </div>
                        </div>
                        
                        <div class="form-group{{ Form::hasError('email') }} email">
                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', old('email'), array('id' => 'email', 'class' => 'form-control','data-option' => old('email'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('first_name') }} first_name">
                            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('first_name', old('first_name'), array('id' => 'first_name', 'class' => 'form-control','data-option' => old('first_name'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('last_name') }} last_name">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('last_name', old('last_name'), array('id' => 'last_name', 'class' => 'form-control','data-option' => old('last_name'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('role') }} role">
                            {!! Form::label('role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('role', array('super-admin' => 'Super Admin',
                                                                'admin' => 'Admin', 
                                                                'user' => 'User'),
                                                                old('role'),array('class'=>'form-control','id'=>'role')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('phone') }} phone">
                            {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', old('phone'), array('id' => 'phone', 'class' => 'form-control number-only','data-option' => old('phone'),'maxlength'=>20)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('bio') }} bio">
                            {!! Form::label('bio', 'Bio', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('bio', old('bio'), array('id' => 'bio', 'class' => 'form-control','data-option' => old('bio'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('countries') }} countries">
                            {!! Form::label('countries', trans('general.countries'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('countries', old('countries'), array('id' => 'countries', 'class' => 'form-control','data-option' => old('countries'))) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('provinces') }} provinces">
                            {!! Form::label('provinces', trans('general.provinces'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('provinces', old('provinces'), array('id' => 'provinces', 'class' => 'form-control','data-option' => old('provinces'))) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('city') }} city">
                            {!! Form::label('city', trans('general.city'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('city', old('city'), array('id' => 'city', 'class' => 'form-control','data-option' => old('city'))) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('address') }} address">
                            {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('address', old('address'), array('id' => 'address', 'class' => 'form-control','data-option' => old('address'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-users') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="button" value="{{ trans('general.button_save') }}" id="button_submit">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.user.script.create_script')