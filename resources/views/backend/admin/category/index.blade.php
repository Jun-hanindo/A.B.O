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
            <h3 class="box-title">{{ trans('general.event_categories') }}</h3>
            <div class="pull-right">
                <a class="btn btn-primary actAdd" href="javascript:void(0)" title="{{ trans('general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a>
                
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <table id="categories-table" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                <thead>
                    <tr>
                        <th class="center-align">{{ trans('general.name') }}</th>
                        <th class="center-align">{{ trans('general.avaibility_on_discover') }}</th>
                        <th class="center-align">{{ trans('general.status') }}</th>
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
            <div class="error-modal"></div>
            <form id="form">
                <input type="hidden" name="id" class="form-control" id="id">
                <div class="form-group name">
                    <label for="event" class="control-label">{{ trans('general.name') }} :</label>
                    {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
                    {!! Form::errorMsg('name') !!}
                </div>
                <div class="form-group icon">
                    <label for="event" class="control-label">{{ trans('general.icon') }} :</label>
                    <select name="icon" id="icon" class="form-control selectpicker" data-live-search="true">
                        @if(!empty($icons))
                            @foreach ($icons as $icon)
                                <optgroup label="{!! $icon['name'] !!}">
                                    @if (isset($icon['child']))
                                        @foreach($icon['child'] as $child)
                                            <option value="{!! $child['name'] !!}" data-icon="fa fa-{!! $child['name'] !!}">icon-{!! $child['name'] !!}</option>
                                        @endforeach
                                    @endif
                            @endforeach
                        @endif
                    </select>
                    {{-- Form::text('icon', old('icon'), array('id' => 'icon', 'class' => 'form-control')) --}}
                    {!! Form::errorMsg('icon') !!}
                </div>
                <div class="form-group description">
                    <label for="event" class="control-label">{{ trans('general.description') }} :</label>
                    {!! Form::textarea('description', old('description'), array('id' => 'description', 'class' => 'form-control tinymce')) !!}
                    {!! Form::errorMsg('description') !!}
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
@include('backend.admin.category.script.index_script')