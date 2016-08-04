@extends('layout.backend.admin.master.master')

@section('title')
    {{ trans('general.events') }} - {{ trans('general.add') }} {{ trans('general.event') }}
@endsection

@section('header')
    {!! Html::style('assets/plugins/datatables/dataTables.bootstrap.css') !!}

    <style>
        .center-align {
            text-align: center;
        }
        .input-group[class*=col-]{
            padding: 0 15px;
        }
        .datepicker.dropdown-menu{
            z-index: 1100 !important;
        }
        #datepicker{
            border-radius: 0;
        }
    </style>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('general.event') }} {{ trans('general.registration') }} </h3>
                </div>
                {!! Form::open(array('url' => route('admin-update-event',$id),'method'=>'POST','id'=>'form-event')) !!}
                    <div class="box-body">
                        <div class="error"></div>
                        <div class="col-md-9">
                            <div class="form-group{{ Form::hasError('title') }} title">
                                {!! Form::label('title', trans('general.title')) !!}
                                {!! Form::text('title', $data->title, ['class' => 'form-control','maxlength'=>'255']) !!}
                                {!! Form::errorMsg('title') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('description') }} description">
                                {!! Form::label('description', trans('general.description')) !!}
                                {!! Form::textarea('description', $data->description, ['class' => 'form-control', 'rows'=> '12']) !!}
                                {!! Form::errorMsg('description') !!}
                            </div>
                            <div class="form-group{{ Form::hasError('addmition_rules') }} addmition_rules">
                                {!! Form::label('addmition_rules', trans('general.addmition_rules')) !!}
                                {!! Form::textarea('addmition_rules', $data->addmition_rules, ['class' => 'form-control', 'rows'=> '7']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_info') }} price_info">
                                {!! Form::label('price_info', trans('general.price_info')) !!}
                                {!! Form::textarea('price_info', $data->price_info, ['class' => 'form-control', 'rows'=> '5']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('price_detail') }} price_detail">
                                <table id="price-detail-datatables" class="table table-hover table-bordered table-condensed table-responsive" data-tables="true">
                                    <thead>
                                        <tr>
                                            <th class="center-align"></th>
                                            <th>{{ trans('general.date') }}</th>
                                            <th>{{ trans('general.time') }}</th>
                                            <th class="center-align">{{ trans('general.info') }}</th>
                                            <th>{{ trans('general.price') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                                <a class="actAdd add-underline" href="javascript:void(0)" title="{{ trans('general.add_more_schedules_and_prices') }}"><u>+ {{ trans('general.add_more_schedules_and_prices') }}</u></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ Form::hasError('slide_image') }} slide_image">
                                {!! Form::label('slide_image', trans('general.slide_image')) !!}
                                {!! Form::file('slide_image', $data->slide_image, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('thumbnail_image') }} thumbnail_image">
                                {!! Form::label('thumbnail_image', trans('general.thumbnail_image')) !!}
                                {!! Form::file('thumbnail_image', $data->thumbnail_image, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('sidebar_image') }} sidebar_image">
                                {!! Form::label('sidebar_image', trans('general.sidebar_image')) !!}
                                {!! Form::file('sidebar_image', $data->sidebar_image, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('event_type') }} event_type">
                                {!! Form::label('event_type', trans('general.event_type')) !!}
                                {!! Form::text('event_type', $data->event_type, ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('venue') }} venue">
                                {!! Form::label('venue', trans('general.venue')) !!}
                                {!! Form::select('venue', array('id' => 'venue'), old('role'), array('class' => 'form-control','data-option' => old('venue'))) !!}
                            </div>
                            <div class="form-group{{ Form::hasError('buy_button_link') }} buy_button_link">
                                {!! Form::label('buy_button_link', trans('general.buy_button_link')) !!}
                                {!! Form::text('buy_button_link', $data->event_type, ['class' => 'form-control','maxlength'=>'255']) !!}
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('admin-index-event') }}" class="btn btn-default">{{ trans('general.button_cancel') }}</a>
                                <input class="btn btn-primary pull-right" title="{{ trans('general.button_save') }}" type="button" value="{{ trans('general.button_publish') }}" id="button_submit">
                            </div>
                        </div>
                        
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ModalLabel"><span id="title-create" style="display:none">{{ trans('general.add_schedule_and_price') }}</span><span id="title-update" style="display:none">{{ trans('general.edit') }}</span></h4>
          </div>
          <div class="modal-body">
            <div class="error"></div>
            <form id="form" class="form-horizontal">
                <div class="form-group">
                    {!! Form::label('date', trans('general.date'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-4">
                        {!! Form::text('date', old('date'), ['class' => 'form-control','maxlength'=>'255']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('time', trans('general.time'), array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-9">
                        {!! Form::text('time', old('time'), ['class' => 'form-control','maxlength'=>'255']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('additional_info', trans('general.additional_info'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('additional_info', old('additional_info'), ['class' => 'form-control', 'rows'=> '5']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-9 input-group">
                        <span class="input-group-addon">$</span>
                        {!! Form::text('price', old('price'), ['class' => 'form-control','maxlength'=>'255']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('price', trans('general.price'), array('class' => 'col-sm-3 control-label pull-left')) !!}
                    <div class="col-sm-4">
                        {!! Form::select('price', array('id' => '/person'), old('role'), array('class' => 'form-control','data-option' => old('price'))) !!}
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="button_save" class="btn btn-primary" title="{{ trans('general.button_save') }}">{{ trans('general.button_save') }}</button>
          </div>
        </div>
      </div>
    </div>
@endsection
@include('backend.admin.event.script.create_script')