@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.users') }} {{ trans('general.management') }} - {{ trans('general.view') }}
@endsection

@section('page-header')
    {{ trans('general.users') }} {{ trans('general.management') }} <small>{{trans('general.view')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-users') !!}">{{ trans('general.users') }} {{ trans('general.management') }}</a></li>
        <li class="active">{{ trans('general.view') }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.view') }}</h3>
                </div>
                    {!! Form::open(array('class'=>'form-horizontal')) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label ']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->username }}</div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->email }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->first_name }}</div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->last_name }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('role') }} role">
                            {!! Form::label('role', 'Role', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data['RoleUsers'][0]->name }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('phone') }} phone">
                            {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->phone }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('bio') }} bio">
                            {!! Form::label('bio', 'Bio', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->bio }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('countries') }} countries">
                            {!! Form::label('countries', trans('general.countries'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->countries }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('provinces') }} provinces">
                            {!! Form::label('provinces', trans('general.provinces'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->provinces }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('city') }} city">
                            {!! Form::label('city', trans('general.city'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->city ? $data->city : "-" }}</div>
                            </div>
                        </div>

                        <div class="form-group{{ Form::hasError('address') }} address">
                            {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border">: {{ $data->address }}</div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-users') }}" class="btn btn-default">{{ trans('general.button_back') }}</a>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.user.script.create_script')