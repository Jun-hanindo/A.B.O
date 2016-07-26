@extends('layout.backend.admin.master.master')

@section('title', 'Hastags Management')

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
    </style>
@endsection

@section('page-header', 'Hastags Management')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-map"></i> Home</a></li>
        <li class="active">{{ trans('general.list') }} {{ trans('general.hastags') }}</li>
    </ol>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.list') }} {{ trans('general.hastags') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="hastags-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">ID</th>
                        <th class="center-align">Name</th>
                        <th class="center-align">Active</th>
                        <th width="12%">Action</th>
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
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('general.create_new') }}</span><span id="title-update" style="display:none">{{ trans('general.edit') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                <label for="recipient-name" class="control-label">{{ trans('general.name') }} {{ trans('general.hastag') }}:</label>
                <input type="text" name="name" class="form-control" id="name" maxlength="255">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Active:</label>
                {!! Form::select('active', array('true' => 'True','false' => 'False'),old('active'),array('class'=>'form-control','id'=>'active')) !!}
              </div>
              <div class="form-group slug">
                <label for="message-text" class="control-label">Slug:</label>
                <input type="text" name="slug" class="form-control" id="slug" maxlength="255" readonly>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" title="{{ trans('general.button_cancel') }}">{{ trans('general.button_cancel') }}</button>
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
            <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@include('backend.admin.hastag.script.index_script')