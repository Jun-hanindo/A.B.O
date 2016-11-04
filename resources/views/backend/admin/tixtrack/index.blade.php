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
            <h3 class="box-title">{{ trans('general.member') }}</h3>
            <div class="pull-right">
                <span class="error-add-member"></span>
            </div>
        </div>
        <div class="box-body">
            <div class="form-inline activity-log-filter-date">
                <div class="form-group">
                    <label for="filter" class="">{{ trans('general.account') }} </label>
                    {!! Form::select('account_id_member', $dropdown, null, ['class' => 'form-control', 'id' => 'account_id_member']) !!}
                </div>
            </div>
            <table id="member-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('general.customer_id') }}</th>
                        <th class="center-align">{{ trans('general.email') }}</th>
                        <th class="center-align">{{ trans('general.first_name') }}</th>
                        <th class="center-align">{{ trans('general.last_name') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.transaction') }}</h3>
            <div class="pull-right">
                <span class="error-add-transaction"></span>
            </div>
        </div>
        <div class="box-body">
            <div class="form-inline activity-log-filter-date">
                <div class="form-group">
                    <label for="filter" class="">{{ trans('general.account') }} </label>
                    {!! Form::select('account_id_order', $dropdown, null, ['class' => 'form-control', 'id' => 'account_id_order']) !!}
                </div>
            </div>
            <table id="transaction-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('general.order_id') }}</th>
                        <th class="center-align">{{ trans('general.event') }}</th>
                        <th class="center-align">{{ trans('general.customer') }}</th>
                        <th class="center-align">{{ trans('general.price') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.index')