@extends('layout.backend.admin.master.master')

@section('title')
    {{trans('general.manage_page')}} - {{ trans('general.about_us') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.about_us') }} {{ trans('general.page') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-update-about-us'),'method'=>'POST','id'=>'form-about-us')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control tinymce','rows'=>'18']) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.manage_page.script.form_script')