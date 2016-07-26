@extends('layout.backend.admin.master.master')

@section('title', 'Menu Management')

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header', 'Menu Management')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-bars"></i> Home</a></li>
        <li class="active">Menu Management</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Menu Management</h3>
            <a class="btn btn-primary pull-right" href="{{ action('Backend\Admin\UserTrustee\MenuController@create') }}" title="Add"><i class="fa fa-plus fa-fw"></i></a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="menus-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">Name</th>
                        <th class="center-align">Parent</th>
                        <th class="center-align">Href</th>
                        <th width="12%">&nbsp;</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('assets/plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('assets/plugins/datatables/dataTables.bootstrap.min.js') !!}

    <script>
        $(document).ready(function() {
            $('#menus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! action('Backend\Admin\UserTrustee\MenuController@datatables') !!}',
                columns: [
                    {data: 'display_name', name: 'display_name'},
                    {data: 'is_parent', name: 'is_parent'},
                    {data: 'href', name: 'href'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection