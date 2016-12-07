@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.homepages') }}
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
            <h3 class="box-title">{{ trans('backend/general.event_categories') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="categories-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.name') }}</th>
                        <th width="20%" class="center-align">{{ trans('backend/general.avaibility_on_discover') }}</th>
                        <th width="20%" class="center-align">{{ trans('backend/general.status') }}</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('backend.admin.category.form_modal')

@endsection
@include('backend.admin.category.script.index_script')