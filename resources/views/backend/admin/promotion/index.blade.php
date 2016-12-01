@extends('layout.backend.admin.master.master')

@section('title')
{{ trans('backend/general.promotions') }}
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
            <h3 class="box-title">{{ trans('backend/general.promotions') }}</h3>
            <div class="pull-right">
                {{-- <a class="btn btn-primary" href="{{ route('admin-create-promotion') }}" title="{{ trans('backend/general.create_new') }}"><i class="fa fa-plus fa-fw"></i></a> --}}
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            <div class="error"></div>
            <form id="form">
                <!-- <div class="col-md-12">
                    <div class="row  form-group">
                        <div class=" col-md-2 nopadding">
                            {!! Form::select('bulk_action', array('' => 'Bulk Action', 'delete' => 'Delete', 'enable' => 'Enable', 'disable' => 'Disable'), old('bulk_action'), array('class' => 'form-control','data-option' => old('bulk_action'))) !!}
                        </div>
                        <div class=" col-md-2">
                            <button type="button" id="{{ trans('backend/general.button_apply') }}" class="btn btn-primary" title="{{ trans('backend/general.button_apply') }}">{{ trans('backend/general.button_apply') }}</button>
                        </div>
                    </div>
                </div> -->
                <table id="promotion-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                    <thead>
                        <tr>
                            <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                            <th class="center-align">{{ trans('backend/general.promotion_title') }}</th>
                            <th class="center-align">{{ trans('backend/general.post_by') }}</th>
                            <th width="20%" class="center-align">{{ trans('backend/general.avaibility') }}</th>
                            <th width="12%"></th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
@endsection
@include('backend.admin.promotion.script.index_script')