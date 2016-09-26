@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.subscribers') }}
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
            <h3 class="box-title">{{ trans('general.subscribers') }}</h3>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <form id="form">
                <table id="subscription-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                    <thead>
                        <tr>
                            <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                            <th class="center-align">{{ trans('general.email') }}</th>
                            <th class="center-align">{{ trans('general.first_name') }}</th>
                            <th class="center-align">{{ trans('general.last_name') }}</th>
                            <th width="12%">&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.subscription.script.index_script')