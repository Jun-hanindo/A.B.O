@extends('layout.backend.admin.master.master')

@section('title')
Tixtrack
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

@endsection

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('backend/general.member') }}</h3>
            <div class="pull-right">
                <span class="error-add-member"></span>
            </div>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.account') }} </label>
                    <div class="col-sm-2">
                        {!! Form::select('account_id_member', $dropdown, null, ['class' => 'form-control', 'id' => 'account_id_member']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.customer_id') }} </label>
                    <div class="col-sm-2">
                        {!! Form::text('customer_id', old('customer_id'), ['class' => 'form-control number-only', 'id' => 'customer_id']) !!}
                    </div>
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.email') }} </label>
                    <div class="col-sm-2">
                        {!! Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.first_name') }} </label>
                    <div class="col-sm-2">
                        {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'id' => 'first_name']) !!}
                    </div>
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.last_name') }} </label>
                    <div class="col-sm-2">
                        {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'id' => 'last_name']) !!}
                    </div>
                </div>
            </div>
            <table id="member-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('backend/general.customer_id') }}</th>
                        <th class="center-align">{{ trans('backend/general.email') }}</th>
                        <th class="center-align">{{ trans('backend/general.first_name') }}</th>
                        <th class="center-align">{{ trans('backend/general.last_name') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('backend/general.transaction') }}</h3>
            <div class="pull-right">
                <span class="error-add-transaction"></span>
            </div>
        </div>
        <div class="box-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.account') }} </label>
                    <div class="col-sm-2">
                        {!! Form::select('account_id_order', $dropdown, null, ['class' => 'form-control', 'id' => 'account_id_order']) !!}
                    </div>
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.order_status') }} </label>
                    <div class="col-sm-2">
                        {!! Form::select('order_status', array('all' => 'All', 'Accepted' => 'Accepted', 'Cancelled' => 'Cancelled'), null, ['class' => 'form-control', 'id' => 'order_status']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.order_item_type') }} </label>
                    <div class="col-sm-2">
                        {!! Form::select('order_item_type', array('all' => 'All', 'Ticket' => 'Ticket', 'Delivery' => 'Delivery', 'Fee' => 'Fee'), null, ['class' => 'form-control', 'id' => 'order_item_type']) !!}
                    </div>
                    <label for="filter" class="col-sm-1 control-label width-percent-12 left-align">{{ trans('backend/general.from') }} </label>
                    <div class="col-sm-2">
                        <input name="local_created" class="form-control datepicker" id="local_created" data-date-end-date="0d" value="{{ date('Y-m-d',strtotime('-7days')) }}">
                    </div>
                    <label for="filter" class="col-sm-1 control-label left-align width-percent-4">{{ trans('backend/general.to') }} </label>
                    <div class="col-sm-2">
                        <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <table id="transaction-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('backend/general.order_id') }}</th>
                        <th class="center-align">{{ trans('backend/general.local_created') }}</th>
                        <th class="center-align">{{ trans('backend/general.event') }}</th>
                        <th class="center-align">{{ trans('backend/general.customer') }}</th>
                        <th class="center-align">{{ trans('backend/general.price') }}</th>
                        <th class="center-align">{{ trans('backend/general.order_status') }}</th>
                        <th class="center-align">{{ trans('backend/general.order_item_type') }}</th>
                        <th class="center-align">{{ trans('backend/general.seat_id') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.index_script')