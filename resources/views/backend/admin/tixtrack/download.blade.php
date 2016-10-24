@extends('layout.backend.admin.master.master')

@section('title', 'Download')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-profile" data-toggle="tab">Switch Account</a></li>
                    <li><a href="#tab-password" data-toggle="tab">Switch Event</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-profile">
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
                    <div class="tab-pane" id="tab-password">
                        {!! Form::open(array('url' => route('admin-tixtrack-download-transaction'),'method'=>'GET','id'=>'form-tixtrack')) !!}
                            <div class="box-body">
                                @include('flash::message')
                                <div id="switch-event" class="tixtrack-switch">
                                    
                                </div>
                                <div class="box-footer">
                                    {!! Form::submit('Apply', ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-profile" data-toggle="tab">Member Data</a></li>
                    <li><a href="#tab-password" data-toggle="tab">Transaction Data</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-profile">
                        {!! Form::open(array('url' => route('admin-tixtrack-download-member'),'method'=>'GET','id'=>'form-member')) !!}
                            <div class="box-body">
                                @include('flash::message')
                                <div id="member-filter" class="tixtrack-filter">
                                    <table class="table" id="member-table">
                                        <tbody></tbody>
                                    </table>
                                    <div class="addFilter">
                                        <a href="javascript:void(0)" id="addMemberFilter" onclick="addMemberFilter()">+ Add Filter Condition</a>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    {!! Form::submit('Download', ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane" id="tab-password">
                        {!! Form::open(array('url' => route('admin-tixtrack-download-transaction'),'method'=>'GET','id'=>'form-tixtrack')) !!}
                            <div class="box-body">
                                @include('flash::message')
                                <div id="transaction-filter" class="tixtrack-filter">
                                    <table class="table" id="transaction-table">
                                        <tbody></tbody>
                                    </table>
                                    <div class="addFilter">
                                        <a href="javascript:void(0)" id="addTransactionFilter" onclick="addTransactionFilter()">+ Add Filter Condition</a>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    {!! Form::submit('Download', ['class' => 'btn btn-primary pull-right']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.tixtrack.script.download')