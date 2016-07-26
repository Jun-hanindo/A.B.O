@extends('layout.backend.admin.master.master')

@section('title', 'Countries Management')

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header', 'Countries Management')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-map"></i> Home</a></li>
        <li class="active">{{ trans('general.list') }} {{ trans('general.countries') }}</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.list') }} {{ trans('general.countries') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-create-country') }}" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="countries-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">ID</th>
                        <th class="center-align">Name</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.country.script.index_script')