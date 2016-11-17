@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('general.homepages') }}
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
            <h3 class="box-title">{{ trans('general.slider') }}</h3>
            <div class="pull-right">
                <span class="error-add-slider"></span>
                <a class="btn btn-primary actAdd" href="javascript:void(0)" data-category="slider" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @if(\Session::has('slider'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {!! \Session::get('slider') !!}
                </div>
            @endif
            <div class="error-slider"></div>
            <table id="homepage-sliders-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th width="12%">{{ trans('general.sort_order') }}</th>
                        <th class="center-align">{{ trans('general.event') }}</th>
                        <!-- <th class="center-align">Category</th> -->
                        <th width="12%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.event') }}</h3>
            <div class="pull-right">
                <span class="error-add-event"></span>
                <a class="btn btn-primary actAdd" href="javascript:void(0)" data-category="event" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @if(\Session::has('event'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ \Session::get('event') }}
                </div>
            @endif
            <div class="error-event"></div>
            <table id="homepage-events-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th width="12%">{{ trans('general.sort_order') }}</th>
                        <th class="center-align">{{ trans('general.event') }}</th>
                        <!-- <th class="center-align">Category</th> -->
                        <th width="12%">{{ trans('general.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.promotion') }}</h3>
            <div class="pull-right">
                <span class="error-add-promotion"></span>
                <a class="btn btn-primary actAdd" href="javascript:void(0)" data-category="promotion" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @if(\Session::has('promotion'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ \Session::get('promotion') }}
                </div>
            @endif
            <div class="error-promotion"></div>
            <table id="homepage-promotions-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th width="12%">{{ trans('general.sort_order') }}</th>
                        <th class="center-align">{{ trans('general.event') }}</th>
                        <!-- <th class="center-align">Category</th> -->
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
                <div class="form-group event_id">
                    <label for="event" class="control-label">{{ trans('general.event') }} *</label>
                    {!! Form::text('event_id', old('event_id'), array('id' => 'event_id', 'class' => 'form-control','data-option' => old('event_id'))) !!}
                    {!! Form::errorMsg('event_id') !!}
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
@include('backend.admin.homepage.script.index_script')