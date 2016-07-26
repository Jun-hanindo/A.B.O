@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.users') }} {{ trans('general.management') }} - {{ trans('general.edit') }}
@endsection

@section('page-header')
    {{ trans('general.users') }} {{ trans('general.management') }} <small>{{trans('general.edit')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-users') !!}">{{ trans('general.users') }} {{ trans('general.management') }}</a></li>
        <li class="active">{{ trans('general.edit') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.edit') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-users'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-users')) !!}
                    <div class="box-body">
                    <div class="error"></div>
                        {!! Form::hidden('id', $data->id, array('id' => 'id', 'class' => 'form-control')) !!}
                        <div class="form-group{{ Form::hasError('username') }} username">
                            {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label ']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('username', $data->username, array('id' => 'username', 'class' => 'form-control block-space','data-option' => old('username'),'maxlength'=>255)) !!}
                            </div>
                        </div>
                        
                        <div class="form-group{{ Form::hasError('email') }} email">
                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', $data->email, array('id' => 'email', 'class' => 'form-control','data-option' => old('email'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('first_name') }} first_name">
                            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('first_name', $data->first_name, array('id' => 'first_name', 'class' => 'form-control','data-option' => old('first_name'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('last_name') }} last_name">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('last_name', $data->last_name, array('id' => 'last_name', 'class' => 'form-control','data-option' => old('last_name'),'maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('role') }} role">
                            {!! Form::label('role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('role', array('super-admin' => 'Super Admin',
                                                                'admin' => 'Admin', 
                                                                'CRO' => 'CRO',
                                                                'BRO' => 'BRO',
                                                                'MS' => 'MS'),
                                                                $data['RoleUsers'][0]->slug,array('class'=>'form-control','id'=>'role')) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('phone') }} phone">
                            {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', $data->phone, array('id' => 'phone', 'class' => 'form-control number-only','maxlength'=>20)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('bio') }} bio">
                            {!! Form::label('bio', 'Bio', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('bio', $data->bio, array('id' => 'bio', 'class' => 'form-control','maxlength'=>255)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('countries') }} countries">
                            {!! Form::label('countries', trans('general.countries'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('countries', $data->country_id, array('id' => 'countries', 'class' => 'form-control','data-option' => $data->countries)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('provinces') }} provinces">
                            {!! Form::label('provinces', trans('general.provinces'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('provinces', $data->province_id, array('id' => 'provinces', 'class' => 'form-control','data-option' => $data->provinces)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('city') }} city">
                            {!! Form::label('city', trans('general.city'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('city', $data->city_id, array('id' => 'city', 'class' => 'form-control','data-option' => $data->city)) !!}
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('address') }} address">
                            {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('address', $data->address, array('id' => 'address', 'class' => 'form-control','maxlength'=>255)) !!}
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-users') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_update') }}" type="button" value="{{ trans('general.button_update') }}" id="button_update">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.user.script.create_script')