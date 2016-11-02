@extends('layout.backend.admin.master.master')

@section('title')
Tixtrack
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Change Account/Event</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(array('url' => route('admin-tixtrack-change-account'),'method'=>'PUT','id'=>'form-account')) !!}
                        <div class="box-body">
                            @include('flash::message')
                            <div id="switch-account" class="tixtrack-switch">
                                <div class="form-group{{ Form::hasError('account') }} account">
                                    {!! Form::select('account', $account, $account_selected, array('class' => 'form-control')) !!}
                                    {!! Form::errorMsg('account') !!}
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Import Transaction</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(array('url' => route('admin-tixtrack-import-transaction'),'files'=>'true','method'=>'POST','id'=>'form-import')) !!}
                        <div class="box-body">
                            @include('flash::message')
                            <div id="import-transaction" class="tixtrack-import">
                                <div class="form-group{{ Form::hasError('import_transaction') }} import_transaction">
                                    <input id="import_transaction" name="import_transaction" class="form-control" data-name="import_transaction" type="file" value="">
                                    {!! Form::errorMsg('import_transaction') !!}
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Import', ['class' => 'btn btn-primary pull-right']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.member') }}</h3>
            <div class="pull-right">
                <span class="error-add-member"></span>
            </div>
        </div>
        <div class="box-body">
            <table id="member-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('general.customer_id') }}</th>
                        <th class="center-align">{{ trans('general.email') }}</th>
                        <th class="center-align">{{ trans('general.first_name') }}</th>
                        <th class="center-align">{{ trans('general.last_name') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ trans('general.transaction') }}</h3>
            <div class="pull-right">
                <span class="error-add-transaction"></span>
            </div>
        </div>
        <div class="box-body">
            <table id="transaction-datatables" class="table table-hover table-bordered table-condensed table-responsive datatables" data-tables="true">
                <thead>
                    <tr>
                        <!-- <th><input name="select_all" value="1" type="checkbox" class="select_all-checkbox"></th> -->
                        <th class="center-align">{{ trans('general.order_id') }}</th>
                        <th class="center-align">{{ trans('general.event') }}</th>
                        <th class="center-align">{{ trans('general.customer') }}</th>
                        <th class="center-align">{{ trans('general.price') }}</th>
                        {{-- <th width="12%"></th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.index')