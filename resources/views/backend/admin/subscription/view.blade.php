@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.subscription') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.subscription_detail') }} </h3>
                </div>
                <div class="box-body">
                    <form class="">
                        <div class="error"></div>
                        <input type="hidden" id="subscription_id" value="{{ $data->id }}">
                        <div class="form-group pull-left full-width">
                            {!! Form::label('subject', trans('general.first_name'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border nopadding">: {{ $data->first_name }}</div>
                            </div>
                        </div>
                        <div class="form-group pull-left full-width">
                            {!! Form::label('name', trans('general.last_name'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border nopadding">: {{ $data->last_name }}</div>
                            </div>
                        </div>
                        <div class="form-group pull-left full-width">
                            {!! Form::label('email', trans('general.contact_number'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="form-control no-border nopadding">: {{ $data->country_code.' '.$data->contact_number }}</div>
                            </div>
                        </div>
                        <div class="form-group pull-left full-width">
                            {!! Form::label('contact_number', trans('general.event'), ['class' => 'col-sm-3 control-label']) !!}
                        </div>
                        <table id="event-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                            <thead>
                                <tr>
                                    <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                                    <th class="center-align">{{ trans('general.title') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                </div>
                <div class="box-footer">
                    <a href="{{ route('admin-index-subscription') }}" class="btn btn-default">{{ trans('general.button_back') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.subscription.script.view_script')