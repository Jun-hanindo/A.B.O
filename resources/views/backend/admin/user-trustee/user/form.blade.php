@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.user_management').' - '.$title)

{{-- @section('page-header', 'User Management <small>'.$title.'</small>') --}}

{{-- @section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-users"></i> Home</a></li>
        <li><a href="{!! action('Backend\Admin\UserTrustee\UserController@index') !!}">User Management</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection --}}

@section('content')
    <div class="row">
        <!-- <div class="col-md-6 col-md-offset-3"> -->
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                {!! Form::modelHorizontal($user, $form) !!}
                    <div class="box-body">
                        @if (! empty($user['avatar']))
                            <div class="form-group">
                                <div class="col-sm-12 display-avatar-form" align="center">
                                    <img src="{!! file_url('avatars/'.$user['avatar'], env('FILESYSTEM_DEFAULT')) !!}" width="120" class="img-circle img-responsive">
                                </div>
                            </div>
                        @endif
                        <div class="form-group{{ Form::hasError('avatar') }}">
                            {!! Form::label('avatar', trans('backend/general.avatar'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::file('avatar') !!}
                                {!! Form::errorMsg('avatar') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('role', trans('backend/general.role'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('role', $dropdown, null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('role') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('promoter_id') }}" id="promotor_div" style="display:none;">
                            {!! Form::label('promoter', trans('backend/general.promoter').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('promoter_id', null, ['id' => 'promoter_id', 'class' => 'form-control', 'data-option' => old('promoter_id'), 'placeholder' => trans('backend/general.promoter')]) !!}
                                {!! Form::hidden('promoter_name', null, ['id' => 'promoter_name', 'class' => 'form-control']) !!}
                                {!! Form::errorMsg('promoter_id') !!}
                            </div>
                        </div>
                        {{-- <div class="form-group{{ Form::hasError('username') }}">
                            {!! Form::label('username', 'Username', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.username')]) !!}
                                {!! Form::errorMsg('username') !!}
                            </div>
                        </div> --}}
                        <div class="form-group{{ Form::hasError('email') }}">
                            {!! Form::label('email', trans('backend/general.email').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.email')]) !!}
                                {!! Form::errorMsg('email') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('first_name') }}">
                            {!! Form::label('first_name', trans('backend/general.first_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.first_name')]) !!}
                                {!! Form::errorMsg('first_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('last_name') }}">
                            {!! Form::label('last_name', trans('backend/general.last_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.last_name')]) !!}
                                {!! Form::errorMsg('last_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('phone') }}">
                            {!! Form::label('phone', trans('backend/general.cellphone').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.cellphone')]) !!}
                                {!! Form::errorMsg('phone') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('address') }}">
                            {!! Form::label('address', trans('backend/general.address').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => trans('backend/general.address')]) !!}
                                {!! Form::errorMsg('address') !!}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            {!! Form::label('branch', 'Branch', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('branch', $dropdown_branch, null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('branch') !!}
                            </div>
                        </div> --}}
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('backend/general.button_save'), ['id' => 'button_save', 'class' => 'btn btn-primary pull-right', 'title' => 'Save']) !!}
                        <button type="submit" id="button_reactivate" class="btn btn-primary pull-right" style="display:none" title="{{ trans('backend/general.button_reactivate') }}">{{ trans('backend/general.button_reactivate') }}</button>
                        {!! link_to_action('Backend\Admin\UserTrustee\UserController@index', trans('backend/general.button_cancel'), [], ['class' => 'btn btn-default pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.user-trustee.user.script.form_script')