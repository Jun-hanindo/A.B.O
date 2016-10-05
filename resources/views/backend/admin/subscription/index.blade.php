@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.subscribers') }}
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
            <h3 class="box-title">{{ trans('general.subscribers') }}</h3>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <div class="form-inline activity-log-filter-date">
                <div id="date-picker" class="form-group">
                    <label for="start-date">{{ trans('general.from') }}</label>
                    <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value={{ date('Y-m-d',strtotime('-7days')) }}>

                    <label for="end-date">{{ trans('general.to') }}</label>
                    <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value={{ date('Y-m-d') }}>
                </div>
            </div>
            <table id="subscription-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('general.email') }}</th>
                        <th class="center-align">{{ trans('general.first_name') }}</th>
                        <th class="center-align">{{ trans('general.last_name') }}</th>
                        <th class="center-align">{{ trans('general.date') }}</th>
                        <th width="12%">&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.subscription.script.index_script')