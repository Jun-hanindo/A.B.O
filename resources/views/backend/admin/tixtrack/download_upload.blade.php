@extends('layout.backend.admin.master.master')

@section('title', 'Download')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Change Account/Event</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(array('url' => route('admin-tixtrack-download-data'),'method'=>'PUT','id'=>'form-account')) !!}
                        <div class="box-body">
                            @include('flash::message')
                            <div id="switch-account" class="tixtrack-switch">
                                <div class="form-group{{ Form::hasError('account') }} account">
                                    {!! Form::select('account', $account, $account_selected, array('class' => 'form-control')) !!}
                                    {!! Form::errorMsg('account') !!}
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right', 'id' => 'button_apply']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Download Data Member and Transaction</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        {!! Form::open(array('url' => route('admin-tixtrack-download-member'),'files'=>'true','method'=>'GET','id'=>'form-download')) !!}
                            {!! Form::submit('Download Member', ['class' => 'btn btn-block btn-primary btn-lg']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::open(array('url' => route('admin-tixtrack-download-transaction'),'files'=>'true','method'=>'POST','id'=>'form-download')) !!}
                            {!! Form::submit('Download Transaction', ['class' => 'btn btn-block btn-success btn-lg']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Import Data Member and Transaction</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(array('url' => route('admin-tixtrack-import'),'files'=>'true','method'=>'POST','id'=>'form-import')) !!}
                        <div class="box-body">
                            @if(\Session::has('member'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ \Session::get('member') }}
                                </div>
                            @endif
                            @if(\Session::has('transaction'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ \Session::get('transaction') }}
                                </div>
                            @endif
                            @if(\Session::has('import_error'))
                                <div class="alert alert-error alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ \Session::get('import_error') }}
                                </div>
                            @endif
                            <div id="import-transaction" class="tixtrack-import">
                                <div class="form-group{{ Form::hasError('import_member') }} import_member">
                                    {!! Form::label('member', trans('general.member')) !!}
                                    <input id="import_member" name="import_member" class="form-control" data-name="import_member" type="file" value="">
                                    {!! Form::errorMsg('import_member') !!}
                                </div>
                                <div class="form-group{{ Form::hasError('import_transaction') }} import_transaction">
                                    {!! Form::label('transaction', trans('general.transaction')) !!}
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
@endsection
@include('backend.admin.tixtrack.script.download')