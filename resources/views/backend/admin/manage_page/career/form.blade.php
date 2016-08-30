@extends('layout.backend.admin.master.master')

@section('title')
    {{trans('general.manage_page')}} - {{ trans('general.career') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.career') }} {{ trans('general.page') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-update-career'),'method'=>'POST','id'=>'form-career')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                            <input type="hidden" name="slug" class="form-control" id="slug" value="careers">
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control tinymce','rows'=>'15']) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('admin-career') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                        <input class="btn btn-primary" title="{{ trans('general.button_publish') }}" type="button" value="{{ trans('general.button_publish') }}" id="button_submit">
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.manage_page.script.form_script')