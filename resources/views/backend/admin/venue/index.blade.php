@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.venues') }}
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
            <h3 class="box-title">{{ trans('general.venues') }}</h3>
            <a class="btn btn-primary" href="{{ route('admin-create-venue') }}" title="{{ trans('general.create_new') }}">{{ trans('general.create_new') }}</a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <form id="form">
                <div class="col-md-12">
                    <div class="row  form-group">
                        <div class=" col-md-2 nopadding">
                            {!! Form::select('bulk_action', array('' => 'Bulk Action', 'delete' => 'Delete', 'enable' => 'Enable', 'disable' => 'Disable'), old('bulk_action'), array('class' => 'form-control','data-option' => old('bulk_action'))) !!}
                        </div>
                        <div class=" col-md-2">
                            <button type="button" id="{{ trans('general.button_apply') }}" class="btn btn-primary" title="{{ trans('general.button_apply') }}">{{ trans('general.button_apply') }}</button>
                        </div>
                    </div>
                </div>
                <table id="venue-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th>
                            <th class="center-align">{{ trans('general.venue_title') }}</th>
                            <th class="center-align">{{ trans('general.max_capacity') }}</th>
                            <th class="center-align">{{ trans('general.post_by') }}</th>
                            <th class="center-align">{{ trans('general.avaibility') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="checkbox" class="item-checkbox"></td>
                        <td>Jakarta Convention Center</br><a href="#">Edit</a></td>
                        <td>10.000</td>
                        <td>admin</td>
                        <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled" checked></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="item-checkbox"></td>
                      <td>Bayfront Avanue</br><a href="#">Edit</a></td>
                      <td>30.000</td>
                      <td>admin</td>
                      <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled"></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" class="item-checkbox"></td>
                      <td>National Stadium</br><a href="#">Edit</a></td>
                      <td>48.000</td>
                      <td>admin</td>
                      <td><input type="checkbox" name="avaibility" class="avaibility-check" data-animate="false" data-on-text="Enabled" data-off-text="Disabled"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.venue.script.index_script')