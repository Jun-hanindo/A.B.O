@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('backend/general.venues') }} - {{ trans('backend/general.add') }} {{ trans('backend/general.venue') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('backend/general.add') }} {{ trans('backend/general.venue') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-venue'),'method'=>'POST','id'=>'form-venue')) !!}
                    <div class="box-body">
                        @include('flash::message')
                        <div class="error"></div>
                        <div class="col-md-9">
                            <div class="form-group{{ Form::hasError('name') }} name">
                                {!! Form::label('name', trans('backend/general.venue_name').' *') !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.venue_name')]) !!}
                                {!! Form::errorMsg('name') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('city') }} city">
                                {!! Form::label('city', trans('backend/general.city').' *') !!}
                                {!! Form::text('city', old('city'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.city')]) !!}
                                {!! Form::errorMsg('city') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('address') }} address">
                                {!! Form::label('address', trans('backend/general.address').' *') !!}
                                {!! Form::textarea('address', old('address'), ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.address')]) !!}
                                {!! Form::errorMsg('address') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('mrtdirection') }} mrtdirection">
                                {!! Form::label('mrtdirection', trans('backend/general.mrtdirection')) !!}
                                {!! Form::textarea('mrtdirection', old('mrtdirection'), ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.mrtdirection')]) !!}
                                {!! Form::errorMsg('mrtdirection') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('cardirection') }} cardirection">
                                {!! Form::label('cardirection', trans('backend/general.cardirection')) !!}
                                {!! Form::textarea('cardirection', old('cardirection'), ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.cardirection')]) !!}
                                {!! Form::errorMsg('cardirection') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('taxidirection') }} taxidirection">
                                {!! Form::label('taxidirection', trans('backend/general.taxidirection')) !!}
                                {!! Form::textarea('taxidirection', old('taxidirection'), ['class' => 'form-control tinymce', 'rows'=> '5', 'placeholder' => trans('backend/general.taxidirection')]) !!}
                                {!! Form::errorMsg('taxidirection') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('capacity') }} capacity">
                                {!! Form::label('capacity', trans('backend/general.capacity').' *') !!}
                                {!! Form::text('capacity', old('capacity'), ['class' => 'form-control number-only','maxlength'=>'255', 'placeholder' => trans('backend/general.capacity')]) !!}
                                {!! Form::errorMsg('capacity') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('link_map') }} link_map">
                                {!! Form::label('link_map', trans('backend/general.link_map').' *') !!}
                                {!! Form::text('link_map', old('link_map'), ['class' => 'form-control','maxlength'=>'255', 'placeholder' => trans('backend/general.link_map')]) !!}
                                {!! Form::errorMsg('link_map') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('gmap_link') }} gmap_link">
                                {!! Form::label('gmap_link', trans('backend/general.gmap_link').' ('.trans('backend/general.embed').')'.' *') !!}
                                {!! Form::text('gmap_link', old('gmap_link'), ['class' => 'form-control','maxlength'=>'1000', 'placeholder' => trans('backend/general.gmap_link')]) !!}
                                {!! Form::errorMsg('gmap_link') !!}
                            </div>
                            <div class="box-footer">
                                <input class="btn btn-primary pull-right" title="{{ trans('backend/general.button_save') }}" type="submit" value="{{ trans('backend/general.button_publish') }}" id="button_submit">
                                <a href="{{ route('admin-index-venue') }}" class="btn btn-default pull-right">{{ trans('backend/general.button_cancel') }}</a>
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@include('backend.admin.venue.script.create_script')