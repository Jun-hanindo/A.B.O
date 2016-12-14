@extends('layout.backend.admin.master.master')

@section('title', 'Download')

@section('content')

    <div class="row">
        <div class="col-md-12">
            {!! Form::open(array('url' => route('admin-tixtrack-update-data-transaction'),'method'=>'POST','id'=>'form-transaction', 'class' => 'col-sm-12')) !!}
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Download and Update Transaction</h3>
                    </div>
                    <div class="box-body">
                        @include('flash::message')
                        <div id="transaction-filter" class="tixtrack-filter">
                            <div class="form-horizontal">
                                <div class="form-group{{ Form::hasError('account') }} account col-md-4">
                                    <label for="filter" class="col-sm-3 control-label left-align">{{ trans('backend/general.account') }} </label>
                                    <div class="col-sm-8">
                                        @if(isset($accounts))
                                            {!! Form::select('account', $accounts, null, array('placeholder' => '- Choose Account -', 'class' => 'form-control', 'id' => 'swap-account')) !!}
                                            {!! Form::errorMsg('account') !!}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ Form::hasError('start_date') }} start_date col-md-3">
                                    <label for="filter" class="col-sm-3 control-label left-align">{{ trans('backend/general.from') }} </label>
                                    <div class="col-sm-9">
                                        <input name="start_date" class="form-control datepicker" id="start_date" data-date-end-date="0d" value="{{ date('Y-m-d',strtotime('-8days')) }}">
                                    </div>
                                </div>
                                <div class="form-group{{ Form::hasError('end_date') }} end_date col-md-3">
                                    <label for="filter" class="col-sm-2 control-label left-align width-percent-4">{{ trans('backend/general.to') }} </label>
                                    <div class="col-sm-9">
                                        <input name="end_date" class="form-control datepicker" id="end_date" data-date-end-date="0d" value="{{ date('Y-m-d',strtotime('-1days')) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right', 'id' => 'button_update']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.update_transaction_script')