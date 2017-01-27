@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.settings') }} - {{ trans('backend/general.edit') }} {{ trans('backend/general.setting') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.setting_visa') }}</h3>
                </div>

                {!! Form::open(array('url' => route('admin-update-setting'), 'files'=>'true','method'=>'POST','id'=>'form-setting', 'class' => "form-horizontal")) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="form-group{{ Form::hasError('setting.visa_banner_image') }} setting.visa_banner_image" id="div_visa_banner_image">
                            <label for="visa_banner_image" class="col-sm-3 control-label">{{ trans('backend/general.banner_image') }} <br>(1130px x 200px)</label>
                            <div class="col-sm-5">
                                <input id="visa_banner_image" name="setting[visa_banner_image]" class="form-control image" data-name="visa_banner_image" type="file" value="{{ isset($data['visa_banner_image']) ? $data['visa_banner_image'] : null }}">
                                {!! Form::errorMsg('setting.visa_banner_image') !!}
                            </div>
                            <div class="col-sm-4">
                                (Max. size 1 mb)
                            </div>
                        </div>
                        <div class="form-group preview" id="div-preview_visa_banner_image" data-name="visa_banner_image">
                            <label for="visa_banner_image" class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <img src="{{ isset($data['visa_banner_image']) ? file_url('settings/'.$data['visa_banner_image'], env('FILESYSTEM_DEFAULT')) : null }}" name="preview" id="preview_visa_banner_image" height="50%" width="50%">
                                @if(isset($data['visa_banner_image']))
                                    <a href="javascript:void(0)" data-name="visa_banner_image" data-title="Visa Banner Image" data-value="$data['visa_banner_image']" class="btn btn-danger btn-xs delete-visa_banner_image" title="Delete Visa Banner Image" style="margin-left:20px;"><i class="fa fa-trash-o fa-fw"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.visa_banner_image_mobile') }} setting.visa_banner_image_mobile" id="div_visa_banner_image_mobile">
                            <label for="visa_banner_image_mobile" class="col-sm-3 control-label">{{ trans('backend/general.banner_image_mobile') }} <br>(520px x 400px)</label>
                            <div class="col-sm-5">
                                <input id="visa_banner_image_mobile" name="setting[visa_banner_image_mobile]" class="form-control image" data-name="visa_banner_image_mobile" type="file" value="{{ isset($data['visa_banner_image_mobile']) ? $data['visa_banner_image_mobile'] : null }}">
                                {!! Form::errorMsg('setting.visa_banner_image_mobile') !!}
                            </div>
                            <div class="col-sm-4">
                                (Max. size 1 mb)
                            </div>
                        </div>
                        <div class="form-group preview" id="div-preview_visa_banner_image_mobile" data-name="visa_banner_image_mobile">
                            <label for="visa_banner_image_mobile" class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <img src="{{ isset($data['visa_banner_image_mobile']) ? file_url('settings/'.$data['visa_banner_image_mobile'], env('FILESYSTEM_DEFAULT')) : null }}" name="preview" id="preview_visa_banner_image_mobile" height="50%" width="50%">
                                @if(isset($data['visa_banner_image_mobile']))
                                    <a href="javascript:void(0)" data-name="visa_banner_image_mobile" data-title="Visa Banner Image Mobile" data-value="$data['visa_banner_image_mobile']" class="btn btn-danger btn-xs delete-visa_banner_image_mobile" title="Delete Visa Banner Image Mobile" style="margin-left:20px;"><i class="fa fa-trash-o fa-fw"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ Form::hasError('setting.visa_link') }} setting.visa_link" id="div_visa_link">
                            {!! Form::label('visa_link', trans('backend/general.link'), ['class' => 'col-sm-3 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('setting[visa_link]', isset($data['visa_link']) ? $data['visa_link'] : null, ['class' => 'form-control', 'placeholder' => trans('backend/general.link')]) !!}
                                {!! Form::errorMsg('setting.visa_link') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">&nbsp;
                        <a href="{{ route('admin-index-setting') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @include('backend.delete-modal')
@endsection
@include('backend.admin.setting.script.visa_script')