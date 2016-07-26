@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.users') }} {{ trans('general.management') }}
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
    {{ trans('general.users') }} {{ trans('general.management') }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-map"></i> Home</a></li>
        <li class="active">{{ trans('general.list') }} {{ trans('general.users') }}</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.list') }} {{ trans('general.users') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-create-users') }}" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <table id="users-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">ID</th>
                        <th class="center-align">Username</th>
                        <th class="center-align">Email</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Role</th>
                        <th class="center-align">Status</th>
                        <th width="12%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal Restore -->
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p id="p-delete">{{ trans('general.confirmation_delete') }} <strong class="name"></strong> ?</p>
                    <p id="p-restore">{{ trans('general.confirmation_restore') }} <strong class="name"></strong> ?</p>
                </div>
                <div class="modal-footer">
                    {!! Form::open(['id' => 'form-destroy']) !!}
                        <a id="delete-modal-cancel" href="#" class="btn btn-default" data-dismiss="modal">{{ trans('general.button_cancel') }}</a>&nbsp;{!! Form::submit('Continue', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- -->
@endsection
@include('backend.admin.user.script.index_script')