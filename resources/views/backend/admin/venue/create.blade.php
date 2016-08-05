@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.venues') }} - {{ trans('general.add') }} {{ trans('general.venue') }}
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.add') }} {{ trans('general.venue') }}</h3>
                </div>
                {!! Form::open(array('url' => route('admin-post-venue'),'method'=>'POST','id'=>'form-venue')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                        <div class="col-md-9">
                            <div class="form-group{{ Form::hasError('venue_name') }} venue_name">
                                {!! Form::label('venue_name', trans('general.venue_name')) !!}
                                {!! Form::text('venue_name', old('venue_name'), ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! Form::errorMsg('venue_name') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description')) !!}
                                {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows'=> '5']) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('getting_to_venue_by_mrt') }} getting_to_venue_by_mrt">
                                {!! Form::label('getting_to_venue_by_mrt', trans('general.getting_to_venue_by_mrt')) !!}
                                {!! Form::textarea('getting_to_venue_by_mrt', old('getting_to_venue_by_mrt'), ['class' => 'form-control', 'rows'=> '5']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('getting_to_venue_by_car') }} getting_to_venue_by_car">
                                {!! Form::label('getting_to_venue_by_car', trans('general.getting_to_venue_by_car')) !!}
                                {!! Form::textarea('getting_to_venue_by_car', old('getting_to_venue_by_car'), ['class' => 'form-control', 'rows'=> '5']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('getting_to_venue_by_taxi_uber') }} getting_to_venue_by_taxi_uber">
                                {!! Form::label('getting_to_venue_by_taxi_uber', trans('general.getting_to_venue_by_taxi_uber')) !!}
                                {!! Form::textarea('getting_to_venue_by_taxi_uber', old('getting_to_venue_by_taxi_uber'), ['class' => 'form-control', 'rows'=> '5']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('link_map') }} link_map">
                                {!! Form::label('link_map', trans('general.link_map')) !!}
                                {!! Form::text('link_map', old('link_map'), ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('google_maps') }} google_maps">
                                {!! Form::label('google_maps', trans('general.google_maps')) !!}
                                {!! Form::text('google_maps', old('google_maps'), ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin-index-venue') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                                <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="button" value="{{ trans('general.button_publish') }}" id="button_submit">
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection