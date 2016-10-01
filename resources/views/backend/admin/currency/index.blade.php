@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.currencies') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .bootstrap-switch{
            float: left;
        }
    </style>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.currencies') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="currencies-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('general.title') }}</th>
                        <th class="center-align" width="16%">{{ trans('general.code') }}</th>
                        <th class="center-align" width="16%">{{ trans('general.symbol_left') }}</th>
                        <th class="center-align" width="16%">{{ trans('general.symbol_right') }}</th>
                        <th width="12%">{{ trans('general.action') }}</th>
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
                <div class="form-group title">
                    <label for="event" class="control-label">{{ trans('general.title') }} :</label>
                    {!! Form::text('title', old('title'), array('id' => 'title', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('title') !!}
                </div>
                <div class="form-group code">
                    <label for="event" class="control-label">{{ trans('general.code') }} :</label>
                    {!! Form::text('code', old('code'), array('id' => 'code', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('code') !!}
                </div>
                <div class="form-group symbol full-width pull-left">
                    <label for="event" class="control-label full-width">{{ trans('general.symbol') }} :</label>
                    {!! Form::checkbox('symbol_position', '1', true, ['class' => 'form-control pull-left symbol_position', 'data-animate' => 'false', 'data-on-text' => 'Left',  'data-off-color' => 'success', 'data-off-text' => 'Right']) !!}
                    <div class="col-md-3">
                        {!! Form::text('symbol', old('symbol'), array('id' => 'symbol', 'class' => 'form-control')) !!}
                        {!! Form::errorMsg('symbol') !!}
                    </div>
                </div>
                
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
            <button type="button" id="button_update" class="btn btn-primary" title="{{ trans('general.button_update') }}">{{ trans('general.button_update') }}</button>
          </div>
        </div>
      </div>
    </div>

@endsection
@include('backend.admin.currency.script.index_script')