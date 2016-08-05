@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.events') }}
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
            <h3 class="box-title">{{ trans('general.events') }}</h3>
            <a class="btn btn-primary" href="{{ route('admin-create-event') }}" title="{{ trans('general.create_new') }}">{{ trans('general.create_new') }}</a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <form id="form">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class=" col-md-2 nopadding">
                            {!! Form::select('bulk_action', array('' => 'Bulk Action', 'delete' => 'Delete', 'enable' => 'Enable', 'disable' => 'Disable'), old('bulk_action'), array('class' => 'form-control','data-option' => old('bulk_action'))) !!}
                        </div>
                        <div class=" col-md-2">
                            <button type="button" id="{{ trans('general.button_apply') }}" class="btn btn-primary" title="{{ trans('general.button_apply') }}">{{ trans('general.button_apply') }}</button>
                        </div>
                        <div class=" col-md-2">
                            <input name="filter-date" class="monthpicker form-control" value="{{ date('m/Y') }}">
                        </div>
                    </div>
                </div>
                <table id="event-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th>
                            <th class="center-align">{{ trans('general.event_title') }}</th>
                            <th class="center-align">{{ trans('general.post_by') }}</th>
                            <th class="center-align">{{ trans('general.avaibility') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" class="item-checkbox"></td>
                        <td>Maroon5 Concert @ Jakarta</br><a href="#">Edit</a></td>
                        <td>admin</td>
                        <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled" checked></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="item-checkbox"></td>
                      <td>Noah Concert @ Kuala Lumpur</br><a href="#">Edit</a></td>
                      <td>admin</td>
                      <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled" checked></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="item-checkbox"></td>
                      <td>Cat Steven Big Concert @ Singapore</br><a href="#">Edit</a></td>
                      <td>admin</td>
                      <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.event.script.index_script')