@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.provinces') }} {{ trans('general.management') }} - {{ trans('general.edit') }}
@endsection

@section('page-header')
    {{ trans('general.provinces') }} {{ trans('general.management') }} <small>{{trans('general.edit')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-province') !!}">{{ trans('general.provinces') }} {{ trans('general.management') }}</a></li>
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
                {!! Form::open(array('url' => route('admin-post-province'),'method'=>'POST','class'=>'form-horizontal','id'=>'form-province')) !!}
                    <div class="box-body">
                    <div class="error"></div>
                        {!! Form::hidden('id', $data->id, array('id' => 'id', 'class' => 'form-control')) !!}
                        <div class="form-group{{ Form::hasError('countries') }} countries">
                            {!! Form::label('countries', trans('general.countries'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('countries', $data->countries_id, array('id' => 'countries', 'class' => 'form-control','data-option' => $data->countries)) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('name') }} name">
                            {!! Form::label('name', trans('general.name').' '.trans('general.provinces'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', $data->name, ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-province') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="button" value="{{ trans('general.button_update') }}" id="button_update">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.province.script.create_script')