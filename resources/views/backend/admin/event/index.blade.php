@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.events') }}
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
            <h3 class="box-title">{{ trans('backend/general.events') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin-create-event') }}" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <form id="form">
                <!-- <div class="col-md-12">
                    <div class="form-group row">
                        <div class=" col-md-2 nopadding">
                            {!! Form::select('bulk_action', array('' => 'Bulk Action', 'delete' => 'Delete', 'enable' => 'Enable', 'disable' => 'Disable'), old('bulk_action'), array('class' => 'form-control','data-option' => old('bulk_action'))) !!}
                        </div>
                        <div class=" col-md-2">
                            <button type="button" id="{{ trans('backend/general.button_apply') }}" class="btn btn-primary" title="{{ trans('backend/general.button_apply') }}">{{ trans('backend/general.button_apply') }}</button>
                        </div>
                        <div class=" col-md-2">
                            <input name="filter-date" class="monthpicker form-control" value="{{ date('m/Y') }}">
                        </div>
                    </div>
                </div> -->
                <table id="event-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                    <thead>
                        <tr>
                            <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                            
                            <th width="12%">{{ trans('backend/general.sort_order') }}</th>
                            <th class="center-align">{{ trans('backend/general.event_title') }}</th>
                            <th class="center-align">{{ trans('backend/general.post_by') }}</th>
                            @if(\Sentinel::getUser()->promoter_id == 0)
                                <th width="20%" class="center-align">{{ trans('backend/general.avaibility') }}</th>
                            @else
                                <th width="20%" class="center-align">{{ trans('backend/general.status') }}</th>
                            @endif
                            <th width="12%"></th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
<div id="duplicate-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ trans('backend/general.confirmation') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('backend/general.confirmation_duplicate') }} <strong id="name"></strong> ?</p>
            </div>
            <div class="modal-footer">
                <a id="duplicate-modal-cancel" href="#" class="btn btn-primary" data-dismiss="modal">{{ trans('backend/general.button_cancel') }}</a>&nbsp;
                <a id="duplicate-modal-events" href="#" class="continue-duplicate btn btn-default" data-dismiss="modal">{{ trans('backend/general.button_continue') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
@include('backend.admin.event.script.index_script')