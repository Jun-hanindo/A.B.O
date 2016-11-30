@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.departments') }}
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
            <h3 class="box-title">{{ trans('backend/general.departments') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="departments-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.name') }}</th>
                        <th width="20%" class="center-align">{{ trans('backend/general.avaibility') }}</th>
                        <th width="12%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('backend/general.create_new') }} {{ trans('backend/general.department') }}</span><span id="title-update" style="display:none">{{ trans('backend/general.edit') }} {{ trans('backend/general.department') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('backend/general.name') }} * </label>
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('name') !!}
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('backend/general.button_save') }}">{{ trans('backend/general.button_save') }}</button>
            <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('backend/general.button_update') }}">{{ trans('backend/general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@include('backend.admin.department.script.index_script')