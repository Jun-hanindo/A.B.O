@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.user_management') }}
@endsection

{{-- @section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li class="active">User Management</li>
    </ol>
@endsection --}}

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

{{-- @section('page-header', 'User Management') --}}

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('backend/general.user_management') }}</h3>
            <a class="btn btn-primary pull-right" href="{{ action('Backend\Admin\UserTrustee\UserController@create') }}" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="trustees-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.email') }}</th>
                        <th class="center-align">{{ trans('backend/general.first_name') }}</th>
                        <th class="center-align">{{ trans('backend/general.last_name') }}</th>
                        <th class="center-align">{{ trans('backend/general.cellphone') }}</th>
                        <th class="center-align">{{ trans('backend/general.role') }}</th>
                        <th class="center-align">{{ trans('backend/general.last_login') }}</th>
                        <th class="center-align">{{ trans('backend/general.created_at') }}</th>
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
            $('#trustees-table').on('error.dt', function(e, settings, techNote, message) {
                $.ajax({
                    url: '{!! URL::route("admin-activity-log-post-ajax") !!}',
                    type: "POST",
                    dataType: 'json',
                    data: "message= User "+message,
                    success: function (data) {
                        data.message;
                    },
                    error: function(response){
                        response.responseJSON.message
                    }
                });
            });
            
            $('#trustees-table').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 6, "desc" ]],
                ajax: "{!! route('datatables-user-trustees') !!}",
                columns: [
                    {data: 'email', name: 'email'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'role', name: 'role'},
                    {data: 'last_login', name: 'last_login', class: 'center-align', searchable: false},
                    {data: 'created_at', name: 'created_at', class: 'center-align', searchable: false},
                    {data: 'action', name: 'action', class: 'center-align', searchable: false, orderable: false}
                ]
            });
        });
    </script>
    @include('backend.delete-modal-datatables')
@endsection