@extends('layout.backend.admin.master.master')

@section('title', 'Menu Management - '.$title)

@section('page-header', 'Menu Management <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-bars"></i> Home</a></li>
        <li><a href="">Menu Management</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                {!! Form::modelHorizontal($data, $form) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('is_parent', 'Is Parent?', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('is_parent', [false => 'No', true => 'Yes'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('parent', 'Parent', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('parent', $data['dropdown'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('name') }}">
                            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('display_name') }}">
                            {!! Form::label('display_name', 'Display Name', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('display_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('icon') }}">
                            {!! Form::label('icon', 'Icon', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('icon') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('pattern') }}">
                            {!! Form::label('pattern', 'Pattern', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('pattern', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('pattern') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('href') }}">
                            {!! Form::label('href', 'Href', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('href', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('href') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! link_to_action('Backend\Admin\UserTrustee\MenuController@index', 'Back', [], ['class' => 'btn btn-default']).' '.Form::submit('Save', ['class' => 'btn btn-primary pull-right', 'title' => 'Save']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            function enable_disable_parent() {
                if (0 == $('#is_parent').val()) {
                    $('#parent').removeAttr('disabled');
                } else {
                    $('#parent').attr('disabled', 'disabled');
                }
            }

            enable_disable_parent();

            $('#is_parent').change(function () {
                enable_disable_parent();
            });
        });
    </script>
@endsection