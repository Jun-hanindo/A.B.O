@extends('layout.backend.admin.master.master')

@section('title')
    {{trans('backend/general.manage_page')}} - {{ $title }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                    <h5>{!! ($status != '') ? trans('backend/general.status').': <b>'.$status.'</b>' : '' !!}</h5>
                </div>
                {!! Form::open(array('url' => route('admin-post-update-manage-page', $slug),'method'=>'POST','id'=>'form-manage-page')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <input type="hidden" name="title" class="form-control" id="title" value="{{ $title }}">
                        <input type="hidden" name="slug" class="form-control" id="slug" value="{{ $slug }}">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-desktop-content" data-toggle="tab">{{ trans('backend/general.desktop') }}</a></li>
                                <li><a href="#tab-responsive-content" data-toggle="tab">{{ trans('backend/general.mobile') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab-desktop-content">
                                    <div class="form-group{{ Form::hasError('desktop_content') }} desktop_content">
                                        {!! Form::textarea('desktop_content', $content, ['id' => 'desktop_content', 'class' => 'form-control page_content','rows'=>'15']) !!}
                                        {!! Form::errorMsg('desktop_content') !!}
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab-responsive-content">
                                    <div class="form-group{{ Form::hasError('responsive_content') }} responsive_content">
                                        {!! Form::textarea('responsive_content', $responsive_content, ['id' => 'responsive_content', 'class' => 'form-control page_content','rows'=>'15']) !!}
                                        {!! Form::errorMsg('responsive_content') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                        <a href="{{-- URL::to($slug.'?preview=true') --}}" target="_blank" id="button_preview" class="btn btn-success pull-right" data-status='preview' title="{{ trans('backend/general.button_preview') }}">{{ trans('backend/general.button_preview') }}</a>
                        <button type="button" id="button_draft2" class="btn btn-warning pull-right" data-status='draft' title="{{ trans('backend/general.button_draft') }}">{{ trans('backend/general.button_draft') }}</button>
                        <a href="{{ route('admin-manage-page', $slug) }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.manage_page.script.form_script')