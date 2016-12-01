@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.trail'))

@section('header')
        {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

        <style>
                .center-align {
                        text-align: center;
                }
                .activity-log-filter-date {
                        padding-bottom:20px;
                }
                .activity-log-filter-chart {
                        padding-bottom:20px;
                }
        </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.trail') }}</h3>
                </div>
                <div class="box-body">
                    @include('flash::message')
                    <div class="error"></div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.delete_from') }} </label>
                            <div class="col-sm-2">
                                <input name="start_delete" class="form-control datepicker" id="start_delete" data-date-end-date="0d" value={{ date('Y-m-d',strtotime('-7days')) }}>
                            </div>
                            <label for="filter" class="col-sm-1 control-label width-percent-4 left-align">{{ trans('backend/general.to') }} </label>
                            <div class="col-sm-2">
                                <input name="end_delete" class="form-control datepicker" id="end_delete" data-date-end-date="0d" value={{ date('Y-m-d') }}>
                            </div>
                            <button class="btn btn-primary" id="btn_apply_delete" >{{ trans('backend/general.button_apply') }}</button>
                        </div>
                    </div>

                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="filter" class="col-sm-1 control-label width-percent-6 left-align">{{ trans('backend/general.user') }} </label>
                            <div class="col-sm-2">
                                {!! Form::select('user_id', $dropdown, null, ['class' => 'form-control', 'id' => 'user_id']) !!}
                            </div>
                            <label for="filter" class="col-sm-1 control-label width-percent-6 left-align margin-left-50">{{ trans('backend/general.from') }} </label>
                            <div class="col-sm-2">
                                <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value={{ date('Y-m-d',strtotime('-7days')) }}>
                            </div>
                            <label for="filter" class="col-sm-1 control-label width-percent-4 left-align">{{ trans('backend/general.to') }} </label>
                            <div class="col-sm-2">
                                <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value={{ date('Y-m-d') }}>
                            </div>
                        </div>
                    </div>
                    <table id="datatable" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                        <thead>
                            <tr>
                                <th class="center-align">{{ trans('backend/general.date') }}</th>
                                <th class="center-align">{{ trans('backend/general.user') }}</th>
                                <th class="center-align">{{ trans('backend/general.session_id') }}</th>
                                <th class="center-align">{{ trans('backend/general.description') }}</th>
                                <th width="12%">{{ trans('backend/general.ip_address') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="box-footer clearfix">
                </div>
            </div>
        </div>
    </div>
    <!-- end of activity log table -->

@endsection
@section('scripts')
    @include('backend.admin.trail.script.index_script')
@endsection

