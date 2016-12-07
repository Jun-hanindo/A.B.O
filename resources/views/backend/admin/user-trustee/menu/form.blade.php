@extends('layout.backend.admin.master.master')

@section('title', trans('backend/general.menu_management').' - '.$title)

{{-- @section('page-header', 'Menu Management <small>'.$title.'</small>')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{!! route('admin-dashboard') !!}"><i class="fa fa-bars"></i> Home</a></li>
        <li><a href="">Menu Management</a></li>
        <li class="active">{{ $title }}</li>
    </ol>
@endsection --}}

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }} {{ trans('backend/general.menu_management') }} </h3>
                </div>
                {!! Form::modelHorizontal($data, $form) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('is_parent', trans('backend/general.is_parent'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('is_parent', [false => 'No', true => 'Yes'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('parent', trans('backend/general.parent'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('parent', $data['dropdown'], null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('name') }}">
                            {!! Form::label('name', trans('backend/general.name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('display_name') }}">
                            {!! Form::label('display_name', trans('backend/general.display_name').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('display_name') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('icon') }}">
                            {!! Form::label('icon', trans('backend/general.icon').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                <select name="icon" id="icon" class="form-control selectpicker" data-live-search="true">
                                    @if(!empty($data['icons']))
                                        @foreach ($data['icons'] as $icon)
                                            <optgroup label="{!! $icon['name'] !!}">
                                                @if (isset($icon['child']))
                                                    @foreach($icon['child'] as $child)
                                                        <option value="{!! $child['name'] !!}" data-icon="fa fa-{!! $child['name'] !!}" {{ $data['icon'] == $child['name'] ? 'selected' : '' }}>icon-{!! $child['name'] !!}</option>
                                                    @endforeach
                                                @endif
                                        @endforeach
                                    @endif
                                </select>
                                {!! Form::errorMsg('icon') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('pattern') }}">
                            {!! Form::label('pattern', trans('backend/general.pattern').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('pattern', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('pattern') !!}
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('href') }}">
                            {!! Form::label('href', trans('backend/general.href').' *', ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('href', null, ['class' => 'form-control']) !!}
                                {!! Form::errorMsg('href') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::submit(trans('backend/general.button_save'), ['class' => 'btn btn-primary pull-right', 'title' => 'Save']).' '.link_to_action('Backend\Admin\UserTrustee\MenuController@index', trans('backend/general.button_cancel'), [], ['class' => 'btn btn-default pull-right']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function enable_disable_parent() {
            if (0 == $('#is_parent').val()) {
                $('#parent').removeAttr('disabled');
            } else {
                $('#parent').attr('disabled', 'disabled');
            }
        }
        $(document).ready(function () {

            enable_disable_parent();

            $('#is_parent').change(function () {
                enable_disable_parent();
            });
        });
    </script>
@endsection