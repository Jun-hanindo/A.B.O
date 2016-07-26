@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.countries') }} {{ trans('general.management') }} - {{ trans('general.edit') }}
@endsection

@section('page-header')
    {{ trans('general.countries') }} {{ trans('general.management') }} <small>{{trans('general.edit')}}</small>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-hashtag"></i> Home</a></li>
        <li><a href="{!! route('admin-index-country') !!}">{{ trans('general.countries') }} {{ trans('general.management') }}</a></li>
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
                {!! Form::open(array('url' => route('admin-update-country',$id),'method'=>'POST')) !!}
                    <div class="box-body">
                    @include('flash::message')
                        <div class="form-group{{ Form::hasError('name') }}">
                            {!! Form::label('name', trans('general.name'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', $name, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-index-country') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="submit" value="{{ trans('general.button_save') }}">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection