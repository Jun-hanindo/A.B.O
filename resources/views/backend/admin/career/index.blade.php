@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.careers') }}
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
            <h3 class="box-title">{{ trans('backend/general.careers') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-create-career') }}" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <form id="form">
                <table id="career-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                    <thead>
                        <tr>
                            <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                            <th class="center-align">{{ trans('backend/general.position') }}</th>
                            <th class="center-align">{{ trans('backend/general.department') }}</th>
                            <th class="center-align">{{ trans('backend/general.type') }}</th>
                            <th width="20%" class="center-align">{{ trans('backend/general.avaibility') }}</th>
                            <th width="12%"></th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.career.script.index_script')