@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.cities') }} {{ trans('general.management') }} - {{ trans('general.edit') }}
@endsection

@section('page-header')
    {{ trans('general.cities') }} {{ trans('general.management') }} <small>{{trans('general.edit')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-city') !!}">{{ trans('general.cities') }} {{ trans('general.management') }}</a></li>
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
                {!! Form::open(array('url' => route('admin-post-city'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-city')) !!}
                    <div class="box-body">
                    <div class="error"></div>
                        {!! Form::hidden('id', $data->id, array('id' => 'id', 'class' => 'form-control')) !!}
                        <div class="form-group{{ Form::hasError('countries') }} countries">
                            {!! Form::label('countries', trans('general.countries'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('countries', $data->countries_id, array('id' => 'countries', 'class' => 'form-control','data-option' => $data->countries)) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('provinces') }} provinces">
                            {!! Form::label('provinces', trans('general.provinces'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('provinces', $data->provinces_id, array('id' => 'provinces', 'class' => 'form-control','data-option' => $data->provinces)) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('name') }} name">
                            {!! Form::label('name', trans('general.name').' '.trans('general.cities'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', $data->name, ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-city') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_update') }}" type="button" value="{{ trans('general.button_update') }}" id="button_update">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.city.script.create_script')