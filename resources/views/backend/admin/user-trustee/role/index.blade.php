@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.role_management'))

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

{{-- @section('page-header', 'Role Management')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-user-secret"></i> Home</a></li>
        <li class="active">Role Management</li>
    </ol>
@endsection --}}

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('backend/general.role_management') }}</h3>
            <a class="btn btn-primary pull-right" href="{{ action('Backend\Admin\UserTrustee\RoleController@create') }}" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="roles-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.name') }}</th>
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
            $.fn.dataTable.ext.errMode = 'none';
            $('#roles-table').on('error.dt', function(e, settings, techNote, message) {
                $.ajax({
                    url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                    type: "POST",
                    dataType: 'json',
                    data: "message= Role "+message,
                    success: function (data) {
                        data.message;
                    },
                    error: function(response){
                        response.responseJSON.message
                    }
                });
            });
            
            $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 0, "asc" ]],
                ajax: '{!! action('Backend\Admin\UserTrustee\RoleController@datatables') !!}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection