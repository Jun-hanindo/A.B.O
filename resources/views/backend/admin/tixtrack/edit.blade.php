@extends('layout.backend.admin.master.master')

@section('title', 'Download')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Change Account/Event to Update Data</h3>
                </div>
                <div class="box-body">
                    {!! Form::open(array('url' => route('admin-tixtrack-update-data'),'method'=>'PUT','id'=>'form-account')) !!}
                        <div class="box-body">
                            @include('flash::message')
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
                            @if(\Session::has('error_member'))
                                <div class="alert alert-error alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ \Session::get('error_member') }}
                                </div>
                            @endif
                            @if(\Session::has('error_transaction'))
                                <div class="alert alert-error alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ \Session::get('error_transaction') }}
                                </div>
                            @endif
                            <div id="switch-account" class="tixtrack-switch">
                                <div class="form-group{{ Form::hasError('account') }} account">
                                    {!! Form::select('account', $account, $account_selected, array('class' => 'form-control')) !!}
                                    {!! Form::errorMsg('account') !!}
                                </div>
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right', 'id' => 'button_download_import']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.download')