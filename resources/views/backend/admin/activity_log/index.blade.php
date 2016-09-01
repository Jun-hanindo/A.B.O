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
          <div class="form-inline activity-log-filter-date">
            <div class="form-group">
                <label for="filter" class="">{{ trans('general.user') }} </label>
                {!! Form::select('user_id', $dropdown, null, ['class' => 'form-control', 'id' => 'user_id']) !!}
            </div>
          </div>
          @include('flash::message')
          <div class="error"></div>
          <table id="datatable" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
              <thead>
                  <tr>
                      <th class="center-align">Date</th>
                      <th class="center-align">User</th>
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
  @include('backend.admin.activity_log.script.index_script')
@endsection

