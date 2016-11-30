@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.promoters') }}
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
            <h3 class="box-title">{{ trans('backend/general.promoters') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="promoters-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('backend/general.name') }}</th>
                        <th class="center-align">{{ trans('backend/general.country') }}</th>
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
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('backend/general.create_new') }}</span><span id="title-update" style="display:none">{{ trans('backend/general.edit') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error-modal"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('backend/general.name') }} *</label>
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('backend/general.name'))) !!}
                    {!! Form::errorMsg('name') !!}
                </div>
                <div class="form-group country">
                    <label for="event" class="control-label">{{ trans('backend/general.country') }} *</label>
                    {!! Form::text('country', old('country'), array('id' => 'country', 'class' => 'form-control', 'data-option' => old('country'), 'placeholder' => trans('backend/general.country'))) !!}
                    {!! Form::errorMsg('country') !!}
                </div>
                <div class="form-group address">
                    <label for="event" class="control-label">{{ trans('backend/general.address') }} *</label>
                    {!! Form::textarea('address', old('address'), array('id' => 'address', 'class' => 'form-control tinymce', 'placeholder' => trans('backend/general.address'))) !!}
                    {!! Form::errorMsg('address') !!}
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
@include('backend.admin.user-trustee.promoter.script.index_script')