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
            <h1 class="box-title">{{ trans('general.venue') }}</h1>
            <a class="btn btn-primary" href="{{ route('admin-create-venue') }}" title="{{ trans('general.create_new') }}">{{ trans('general.create_new') }}</a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="venue-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align"><input type="checkbox" class="editor-active"></th>
                        <th class="center-align">{{ trans('general.venue_title') }}</th>
                        <th class="center-align">{{ trans('general.max_capacity') }}</th>
                        <th class="center-align">{{ trans('general.post_by') }}</th>
                        <th class="center-align">{{ trans('general.avaibility') }}</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="center-align"><input type="checkbox" class="editor-active"></td>
                    <td>Jakarta Convention Center</br><a href="#">Edit</a></td>
                    <td>10.000</td>
                    <td>admin</td>
                    <td><div class="btn-group">
                        <button type="button" class="btn btn-info">Disabled</button>
                        <button type="button" class="btn btn-info">Enabled</button>
                    </div>
                    </td>
                </tr>
                <tr>
                  <td class="center-align"><input type="checkbox" class="editor-active"></td>
                  <td>Bayfront Avanue</br><a href="#">Edit</a></td>
                  <td>30.000</td>
                  <td>admin</td>
                  <td><div class="btn-group">
                        <button type="button" class="btn btn-info">Disabled</button>
                        <button type="button" class="btn btn-info">Enabled</button>
                    </div>
                    </td>
                </tr>
                <tr>
                  <td class="center-align"><input type="checkbox" class="editor-active"></td>
                  <td>National Stadium</br><a href="#">Edit</a></td>
                  <td>48.000</td>
                  <td>admin</td>
                  <td><div class="btn-group">
                        <button type="button" class="btn btn-info">Disabled</button>
                        <button type="button" class="btn btn-info">Enabled</button>
                    </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.venue.script.index_script')