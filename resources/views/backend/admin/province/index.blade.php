@extends('layout.backend.admin.master.master')

@section('title')
Management Data Provinsi
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header')
    Management Data Provinsi
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-map"></i> Home</a></li>
        <li class="active">List Provinsi</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List Provinsi</h3>
            <div class="pull-right">
                <input type="submit" id="button_submit" value="Ambil Data Provinsi dari KPM" class="btn btn-primary" title="sync-province">
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="provinces-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Kode Provinsi</th>
                        <th class="center-align">Nama Provinsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.province.script.index_script')