@extends('layout.backend.admin.master.master')

@section('title', 'Role Management - '.$title)

@section('header')
    {!! Html::style('assets/plugins/select2/select2.min.css') !!}
@endsection

{{-- @section('page-header', 'Role Management <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! action('Backend\Admin\DashboardController@index') !!}"><i class="fa fa-user-secret"></i> Home</a></li>
        <li><a href="{!! action('Backend\Admin\UserTrustee\RoleController@index') !!}">Role Management</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                {!! Form::modelHorizontal($data, $form) !!}
                    <div class="box-body">
                        <div class="form-group{{ Form::hasError('name') }}">
                            {!! Form::label('name', 'Name *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control', ($data['id'] == 2 || $data['id'] == 1) ? 'readonly' : '' ]) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                        </div>
                        @if($status == "create")
                            <div class="form-group{{ Form::hasError('slug') }}">
                                {!! Form::label('slug', 'Slug', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                                    {!! Form::errorMsg('slug') !!}
                                </div>
                            </div>
                        @endif
                        <div class="form-group{{ Form::hasError('permissions') }}">
                            {!! Form::label('permissions', 'Permissions *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('permissions[]', $data['dropdown'], null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'permissions']) !!}
                                {!! Form::errorMsg('permissions') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! link_to_action('Backend\Admin\UserTrustee\RoleController@index', trans('general.button_cancel'), [], ['class' => 'btn btn-default']).' '.Form::submit('Save', ['class' => 'btn btn-primary pull-right', 'title' => 'Save']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! Html::script('assets/plugins/select2/select2.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#permissions').select2();
        });
    </script>
@endsection