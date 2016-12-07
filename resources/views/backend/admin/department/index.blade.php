@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.departments') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('backend/general.departments') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="departments-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.name') }}</th>
                        <th width="20%" class="center-align">{{ trans('backend/general.avaibility') }}</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    
    @include('backend.admin.department.form_modal')
@endsection
@include('backend.admin.department.script.index_script')