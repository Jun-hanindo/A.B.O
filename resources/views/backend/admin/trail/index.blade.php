@extends('layout.backend.admin.master.master')

@section('title', trans('general.trail'))

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
            <h3 class="box-title">{{ trans('general.trail') }}</h3>
        </div>
        <div class="box-body">
          @include('flash::message')
          <div class="error"></div>
          <div class="form-inline activity-log-filter-date">
            <div class="form-group">
                <label for="filter" class="">{{ trans('general.user') }} </label>
                {!! Form::select('user_id', $dropdown, null, ['class' => 'form-control', 'id' => 'user_id']) !!}
            </div>
            <div style="margin-left:1.5cm;" id="date-picker" class="form-group">
                <label for="start-date">{{ trans('general.from') }}</label>
                <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value={{ date('Y-m-d',strtotime('-7days')) }}>

                <label for="end-date">{{ trans('general.to') }}</label>
                <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value={{ date('Y-m-d') }}>
            </div>
          </div>
          <table id="datatable" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
              <thead>
                  <tr>
                      <th class="center-align">Date</th>
                      <th class="center-align">User</th>
                      <th class="center-align">Session id</th>
                      <th class="center-align">Description</th>
                      <th width="12%">Ip Address</th>
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

