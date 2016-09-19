@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.inbox') }}
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
            <h3 class="box-title">{{ trans('general.inbox') }}</h3>
        </div>
        <div class="box-body">
            <form id="form">
                <table id="message-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                    <thead>
                        <tr>
                            <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                            <th class="center-align">{{ trans('general.name') }}</th>
                            <th class="center-align">{{ trans('general.subject') }}</th>
                            <th class="center-align" width="18%">{{ trans('general.date') }}</th>
                            <th width="12%">&nbsp;</th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.message.script.index_script')